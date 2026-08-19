<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Area;
use App\Models\CustomerAddress;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;


class CartController extends Controller
{
    /**
     * Session mein applied coupon ko resolve kar ke Coupon model return karta hai (ya null).
     */
    protected function resolveCoupon(): ?Coupon
    {
        $code = session('applied_coupon');

        if (! $code) {
            return null;
        }

        $coupon = Coupon::where('code', $code)->first();

        // Agar coupon ab invalid ho chuka hai (expire, disabled, limit khatam),
        // to session se apne aap hata dein taake stale data na reh jaye.
        if (! $coupon || ! $coupon->isValid()) {
            session()->forget('applied_coupon');
            return null;
        }

        return $coupon;
    }

    /**
     * View Cart page.
     */
    public function index()
    {
        if (! auth('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        $cart = session('cart', []);
        $coupon = $this->resolveCoupon();
        $cartService = new CartService($cart, null, $coupon, CartService::METHOD_LOCAL);
        $user = auth('web')->user();
        $serviceableAreas = Area::active()->serviceable()->orderBy('name')->pluck('name', 'id');
        $nonServiceableAreas = Area::active()->nonServiceable()->orderBy('name')->pluck('name', 'id');
        $nonServiceableList = Area::active()->nonServiceable()->orderBy('name')->pluck('name');
        $stockMap = Product::whereIn('id', array_keys($cart))->pluck('quantity', 'id');
        $customer_address = CustomerAddress::where('user_id', $user->id)->get()->mapWithKeys(function ($item) {
            return [$item->id => "{$item->address_type} - ({$item->address})"];
        });

        return view('frontend.cart-checkout', [
            'cartItems' => $cart,
            'summary' => $cartService->summary(),
            'user' => $user,
            'customer_address' => $customer_address,
            'serviceableAreas' => $serviceableAreas,
            'nonServiceableAreas' => $nonServiceableAreas,
            'nonServiceableList' => $nonServiceableList,
            'stockMap' => $stockMap,
            'courierFee' => (float) config('cart.courier_fee', 250),
            'pakistanFee' => (float) config('cart.pakistan_delivery_fee', 350),
        ]);
    }
	
	
	public function addToCart(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return frontend_guest_login_response(
                $request,
                $request->input('return_url', url()->previous()),
                'Please login to continue'
            );
        }
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json([
                'status' => true,
                'message' => 'Product not found.'
            ]);
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += ($request->quantity ?? 1);
        } else {

            $cart[$product->id] = [
                'id'       => $product->id,
                'sku'     => $product->sku,
                'name'     => $product->name,
                'unit'     => $product->unit,
                'price'    => $product->price,
                'discount'    => $product->discount,
                'discount_amount'    => $product->discount_amount,
                'image'    => $product->image,
                'quantity' => ($request->quantity ?? 1),
            ];
        }

        session()->put('cart', $cart);

        //return response()->json(['status' => false]);
		//return view('frontend.includes.minicart')->with('cartmessage', $cartmessage)->render();
    }
	

    /**
     * Cart mein quantity update karein.
     */
    public function update(Request $request, int $productId)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $cart = session('cart', []);

        if (! isset($cart[$productId])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'This product is not in your cart.',
                ], 422);
            }

            return back()->with('error', 'This product is not in your cart.');
        }

        $product = Product::find($productId);

        if (! $product || (int) $product->status !== 1) {
            unset($cart[$productId]);
            session(['cart' => $cart]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'This product is no longer available and has been removed from your cart.',
                    'removed' => true,
                ], 422);
            }

            return back()->with('error', 'This product is no longer available and has been removed from your cart.');
        }

        $quantity = (int) $validated['quantity'];
        $maxStock = (int) ($product->quantity ?? 0);
        $stockLimited = false;

        if ($maxStock > 0 && $quantity > $maxStock) {
            $quantity = $maxStock;
            $stockLimited = true;
        }

        $cart[$productId]['quantity']        = $quantity;
        $cart[$productId]['price']           = $product->price;
        $cart[$productId]['final_price']     = $product->final_price;
        $cart[$productId]['discount']        = $product->discount;
        $cart[$productId]['discount_amount'] = $product->discount_amount;

        session(['cart' => $cart]);

        if ($request->ajax() || $request->wantsJson()) {
            $coupon = $this->resolveCoupon();
            $deliveryMethod = $request->input('delivery_method', CartService::METHOD_LOCAL);
            $area = $request->filled('area_id') ? Area::find($request->area_id) : null;
            $summary = (new CartService($cart, $area, $coupon, $deliveryMethod))->summary();
            $unitPrice = (float) ($cart[$productId]['price'] ?? 0);

            return response()->json([
                'status' => true,
                'message' => $stockLimited
                    ? "Only {$maxStock} items are available in stock."
                    : 'Cart updated successfully.',
                'stock_limited' => $stockLimited,
                'quantity' => $quantity,
                'max_quantity' => $maxStock > 0 ? $maxStock : 100,
                'line_total' => money($unitPrice * $quantity),
                'summary' => [
                    'sub_total' => money($summary['sub_total']),
                    'product_discount' => money($summary['product_discount']),
                    'coupon_discount' => money($summary['coupon_discount']),
                    'after_discount' => money($summary['after_discount']),
                    'delivery_fee' => '+ ' . money($summary['delivery_fee']),
                    'platform_fee' => '+ ' . money($summary['platform_fee']),
                    'order_total' => money($summary['order_total']),
                ],
                'cart_count' => count($cart),
            ]);
        }

        if ($stockLimited) {
            return back()->with('error', "Only {$maxStock} items are available in stock.");
        }

        return back()->with('success', 'Cart updated successfully.');
    }

    /**
     * Cart se ek item remove karein.
     */
    public function remove(int $productId): RedirectResponse
    {
		$cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Pura cart clear karein.
     */
    public function clear(): RedirectResponse
    {
        session()->forget('cart');
        session()->forget('applied_coupon');

        return back()->with('success', 'Cart cleared.');
    }

    /**
     * Coupon apply karein.
     */
    public function applyCoupon(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'coupon_code' => ['required', 'string', 'max:50'],
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty, coupon cannot be applied.');
        }

        $coupon = Coupon::where('code', $validated['coupon_code'])->first();

        if (! $coupon) {
            return back()->with('error', 'This coupon code is invalid.');
        }

        if (! $coupon->isValid()) {
            return back()->with('error', 'This coupon has expired or is no longer available.');
        }

        // Min order amount check - subtotal ke against
        $cartService = new CartService($cart);
        $subTotal = $cartService->subTotal() - $cartService->productDiscount();

        if ($subTotal < $coupon->min_order_amount) {
            $minAmount = CartService::format($coupon->min_order_amount);
            return back()->with('error', "This coupon is only applicable on orders of {$minAmount} or more.");
        }

        session(['applied_coupon' => $coupon->code]);

        return back()->with('success', "Coupon \"{$coupon->code}\" applied successfully!");
    }

    /**
     * Coupon remove karein.
     */
    public function removeCoupon(): RedirectResponse
    {
        session()->forget('applied_coupon');

        return back()->with('success', 'Coupon removed.');
    }
	
    /*
	public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        return view('frontend.checkout', ['cart' => $cart, 'total' => $total]);
    }
    */

    public function cartsummary(Request $request)
    {
        $cart = session('cart', []);
        $coupon = session('applied_coupon')
            ? Coupon::where('code', session('applied_coupon'))->first()
            : null;

        $deliveryMethod = $request->input('delivery_method', CartService::METHOD_LOCAL);
        $area = $request->filled('area_id') ? Area::find($request->area_id) : null;
        $summary = (new CartService($cart, $area, $coupon, $deliveryMethod))->summary();

        return response()->json([
            'delivery_fee' => money($summary['delivery_fee']),
            'order_total' => money($summary['order_total']),
            'sub_total' => money($summary['sub_total']),
            'after_discount' => money($summary['after_discount']),
            'platform_fee' => money($summary['platform_fee']),
            'delivery_method' => $summary['delivery_method'],
            'delivery_fee_raw' => $summary['delivery_fee'],
            'order_total_raw' => $summary['order_total'],
        ]);
    }

    public function placeOrderNew(Request $request): RedirectResponse
    {
     
        // ===================================================================
        // STEP 1: Input validation - SIRF non-financial fields client se lete hain.
        // Price/total/discount client se accept NAHI karte - session cart se
        // server-side calculate karte hain (price tampering se bachne ke liye).
        // ===================================================================
        $validated = $request->validate([
            'customer_name'         => ['required', 'string', 'max:255'],
            'customer_email'        => ['required', 'email', 'max:255'],
            'customer_phone'        => ['required', 'string', 'max:20'],
            'delivery_method'       => ['required', 'in:local,courier,pakistan'],
            'area_id'               => [
                Rule::requiredIf(fn () => in_array($request->delivery_method, ['local', 'courier'], true)),
                'nullable',
                'integer',
                'exists:area,id',
            ],
            'delivery_area_text'    => [
                Rule::requiredIf(fn () => $request->delivery_method === 'pakistan'),
                'nullable',
                'string',
                'max:255',
            ],
            'address_id'            => [
                'required',
                'integer',
                Rule::exists('customer_address', 'id')->where('user_id', auth('web')->id()),
            ],
            'delivery_instruction'  => ['nullable', 'string', 'max:500'],
            'payment_method'        => ['required', 'in:cod,online'],
            'payment_slip' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:2048'],
        ]);
 
        // ===================================================================
        // STEP 2: Cart session se lein - agar khali hai to order place hi nahi ho sakta
        // ===================================================================
        $cart = session('cart', []);
 
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }
 
        // Applied coupon (agar hai) resolve karein
        $couponCode = session('applied_coupon');
        $coupon = $couponCode
            ? \App\Models\Coupon::where('code', $couponCode)->first()
            : null;
 
        if ($coupon && ! $coupon->isValid()) {
            $coupon = null;
            session()->forget('applied_coupon');
        }

        $deliveryMethod = $validated['delivery_method'];
        $area = null;
        $areaLabel = $validated['delivery_area_text'] ?? null;

        if (in_array($deliveryMethod, [CartService::METHOD_LOCAL, CartService::METHOD_COURIER], true)) {
            $area = Area::where('id', $validated['area_id'])->where('status', 1)->firstOrFail();

            if ($deliveryMethod === CartService::METHOD_LOCAL && ! $area->isServiceable()) {
                return back()->withInput()->with('error', 'Selected area is non-serviceable. Please choose Courier Service.');
            }

            if ($deliveryMethod === CartService::METHOD_COURIER && $area->isServiceable()) {
                return back()->withInput()->with('error', 'Courier Service is for non-serviceable areas only. Choose Local Delivery for this area.');
            }

            $areaLabel = $area->name;
        } else {
            $areaLabel = 'Pakistan - ' . ($validated['delivery_area_text'] ?? '');
        }

        $cartService = new CartService($cart, $area, $coupon, $deliveryMethod);
        $summary = $cartService->summary();
 
        // Customer address ka snapshot text nikal lein (order table mein history ke liye save hoga)
        $address = CustomerAddress::findOrFail($validated['address_id']);
        $addressSnapshot = trim("{$address->address_type} - {$address->address}");
        

        // Payment slip upload (agar online payment/bank transfer flow ho)
        $paymentSlipPath = null;
        if ($request->hasFile('payment_slip')) {
            $paymentSlipPath = $request->file('payment_slip')->store('payment-slips', 'public');
        }
 
        // ===================================================================
        // STEP 3: Transaction ke andar - order + items + stock decrement + coupon
        // usage sab ek sath succeed/fail hote hain (atomic operation)
        // ===================================================================
        try {
            $order = DB::transaction(function () use (
                $validated,
                $cart,
                $summary,
                $coupon,
                $addressSnapshot,
                $area,
                $areaLabel,
                $deliveryMethod,
                $paymentSlipPath
            ) {
                // --- Order create karein (order_no ek temporary unique placeholder se -
                // kyunke asal order_no ($order->id par depend karta hai) sirf insert
                // hone ke BAAD generate ho sakta hai. 'order_no' column NOT NULL hai,
                // is liye khali/null nahi chhod sakte pehle insert mein. ---
                $order = Order::create([
                    'order_no'              => 'TEMP-' . uniqid(),
                    'user_id'               => auth('web')->id(),
                    'customer_name'         => $validated['customer_name'],
                    'customer_email'        => $validated['customer_email'],
                    'phone'                 => $validated['customer_phone'],
                    'address'               => $addressSnapshot,
                    'order_source'               => 'Web Application',
                    'area'                  => $areaLabel ?? '',
                    'area_id'               => $area?->id,
                    'delivery_method'       => $deliveryMethod,
                    'delivery_area_text'    => $validated['delivery_area_text'] ?? null,
                    'delivery_instruction'  => $validated['delivery_instruction'] ?? null,
                    'total_amount'          => $summary['sub_total'],
                    'discount'              => $summary['discount'],
                    'coupon_code'           => $summary['coupon_code'],
                    'coupon_discount'       => $summary['coupon_discount'],
                    'after_discount_amount' => $summary['after_discount'],
                    'delivery_charges'      => $summary['delivery_fee'],
                    'platform_fee'          => $summary['platform_fee'],
                    'grand_total'           => $summary['order_total'],
                    'payment_type'          => $validated['payment_method'], // actual column: payment_type
                    'image_payment_slip'    => $paymentSlipPath,             // actual column: image_payment_slip
                    'status'                => 'Pending',                    // enum case-sensitive match
                ]);
 
                // --- Ab $order->id mil chuka hai - asal order_no generate kar ke update karein ---
                $order->order_no = 100000000 + $order->id;
                $order->save();
 
                // --- Har cart item ke liye: stock lock+verify, order item banayein, stock kam karein ---
                foreach ($cart as $productId => $item) {
                    // Row-level lock - taake dusra concurrent order isi waqt stock na le jaye
                    $product = Product::where('id', $productId)->lockForUpdate()->first();
 
                    if (! $product || $product->status !== 1) {
                        throw ValidationException::withMessages([
                            'cart' => "\"{$item['name']}\" is no longer available.",
                        ]);
                    }
 
                    if (isset($product->stock) && $item['quantity'] > $product->stock) {
                        throw ValidationException::withMessages([
                            'cart' => "Only {$product->stock} of \"{$item['name']}\" left in stock.",
                        ]);
                    }
 
                    // NOTE: 'discount_percentage' column naam se lagta hai product-level
                    // discount PERCENTAGE format mein store hota hai (jaise 10 = 10%).
                    // Agar aapka product discount asal mein FLAT amount hai, to formula
                    // adjust karni hogi - filhal percentage assume kiya hai.
                    $discountPercentage = $product->discount ?? 0;
                    $priceAfterDiscount = $product->price - ($product->price * $discountPercentage / 100);
 
                    OrderItem::create([
                        'order_id'             => $order->id,
                        'product_id'           => $product->id,
                        'name'                 => $product->name,
                        'quantity'             => $item['quantity'],
                        'price'                => $product->price,
                        'discount_percentage'  => $discountPercentage,
                        'price_after_discount' => $priceAfterDiscount,
                        'subtotal'             => $priceAfterDiscount * $item['quantity'],
                    ]);
 
                    if (isset($product->stock)) {
                        $product->decrement('stock', $item['quantity']);
                    }
                }
 
                // --- Coupon use ho gaya - usage count barhayein ---
                if ($coupon) {
                    $coupon->increment('used_count');
                }
 
                return $order;
            });
        } catch (ValidationException $e) {
            // Business validation errors (stock khatam, product unavailable) - user ko dikhana theek hai
            return back()->with('error', collect($e->errors())->flatten()->first());
        } catch (Throwable $e) {
            // Unexpected/system errors - detail sirf log mein, user ko generic message
            Log::error('Order placement failed', [
                'user_id' => auth('web')->id(),
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
 
            return back()->with('error', 'Something went wrong while placing your order. Please try again.');
        }
 
        // ===================================================================
        // STEP 4: Success - cart clear karein taake dobara submit na ho,
        // phir Thank You page par redirect karein.
        // ===================================================================
        session()->forget('cart');
        session()->forget('applied_coupon');
        return redirect()->route('frontend.order.thankyou', ['order' => $order->id])->with('success', 'Order placed successfully.');
    }
 
    /**
     * Thank You page - order confirmation
     */
    public function thankYou(Order $order)
    {
        if ($order->user_id !== auth('web')->id()) {
            abort(403);
        }

        return view('frontend.thank-you', ['order' => $order,]);
    }


    
}