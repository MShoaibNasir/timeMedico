<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use App\Models\Area;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Validation\Rule;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerAddress;

use Illuminate\Support\Facades\Validator;
use App\Services\CartService;

use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function filter(Request $request)
    {
        return view('backend.orders.filter');
    }
    public function list(Request $request)
    {
        $page = $request->get('page', 1);
        $qty  = $request->get('qty', 10);
        $payment_type  = $request->get('payment_type');


        $orders = Order::query();

        // Order No
        if ($request->filled('order_no')) {
            $orders->where('order_no', 'LIKE', '%' . $request->order_no . '%');
        }
        if ($request->filled('payment_type')) {
            $orders->where('payment_type', $payment_type);
        }

        // Date
        if ($request->filled('order_date')) {
            $orders->whereDate('created_at', $request->order_date);
        }

        // Customer Name OR Phone
        if ($request->filled('customer_search')) {
            $search = $request->customer_search;

            $orders->where(function ($q) use ($search) {
                $q->where('customer_name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Status
        if ($request->filled('status')) {
            $orders->where('status', $request->status);
        }

        $orders = $orders->latest()
            ->paginate($qty, ['*'], 'page', $page);

        return view('backend.orders.list', [
            'data' => $orders
        ]);
    }

    public function view($id)
    {
        $id = decrypt($id);
        $order = Order::with(['items.product'])->findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,On The way,Delivered,Rejected,Returned',
        ]);

        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
    public function verify(Request $request, $id)
    {
        $order = Order::with('user')->where('id', $id)->first();
        Mail::to($order->customer_email)
            ->send(new OrderConfirmationMail($order));
        return back()->with('success', 'Email sent successfully.');
    }
    public function placeOrderPage(Request $request)
    {
        $areas = Area::where('status', 1)->get();
        $products = Product::where('status', 1)->get();

        return view('backend.orders.placeOrder', ['areas' => $areas, 'product' => $products]);
    }


    public function placeOrderStore(Request $request): RedirectResponse
    {
        // 1. Validation Rules
        $validated = $request->validate([
            'customer_name'        => ['required', 'string', 'max:255'],
            'address'        => ['required', 'string'],
            'customer_email'       => ['required', 'email', 'max:255'],
            'phone'                => ['required', 'string', 'max:20'],
            'area_id'              => ['required', 'integer', 'exists:area,id'],
            'delivery_instruction' => ['nullable', 'string', 'max:500'],
            'payment_type'         => ['required', 'in:cod,online'],
            'payment_slip'         => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ]);

        // 2. Prepare Cart Data
        $productsInput = $request->products ?? [];

        if (empty($productsInput)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Extract IDs & Quantities from Request
        $productIds = array_column($productsInput, 'product_id');
        $quantities = array_column($productsInput, 'quantity', 'product_id');

        // Fetch products in 1 Single Query (Fixes N+1 issue)
        $dbProducts = Product::whereIn('id', $productIds)->get();

        $cartItems = [];
        foreach ($dbProducts as $product) {
            $qty = $quantities[$product->id] ?? ($request->quantity ?? 1);

            $cartItems[$product->id] = [
                'id'              => $product->id,
                'sku'             => $product->sku,
                'name'            => $product->name,
                'unit'            => $product->unit,
                'price'           => (float) $product->price,
                'discount'        => (float) $product->discount,
                'discount_amount' => (float) $product->discount_amount,
                'image'           => $product->image,
                'quantity'        => (int) $qty,
            ];
        }

        if (empty($cartItems)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // 3. Resolve Applied Coupon
        $couponCode = session('applied_coupon');
        $coupon = $couponCode
            ? \App\Models\Coupon::where('code', $couponCode)->first()
            : null;

        if ($coupon && ! $coupon->isValid()) {
            $coupon = null;
            session()->forget('applied_coupon');
        }

        // 4. Cart Calculations & Snapshot
        $area = Area::findOrFail($validated['area_id']);
        $cartService = new CartService($cartItems, $area, $coupon);
        $summary = $cartService->summary();

        $address = CustomerAddress::findOrFail(1);
        $addressSnapshot = trim("{$address->address_type} - {$address->address}");

        // 5. Handle Payment Slip File
        $paymentSlipPath = null;
        if ($request->hasFile('payment_slip')) {
            $paymentSlipPath = $request->file('payment_slip')->store('payment-slips', 'public');
        }

        // 6. Database Transaction
        try {
            $order = DB::transaction(function () use (
                $validated,
                $cartItems,
                $summary,
                $coupon,
                $addressSnapshot,
                $area,
                $paymentSlipPath
            ) {
                // Order Creation
                $order = Order::create([
                    'order_no'              => 'TEMP-' . uniqid(),
                    'user_id'               => auth('web')->id(),
                    'customer_name'         => $validated['customer_name'],
                    'customer_email'        => $validated['customer_email'],
                    'phone'                 => $validated['phone'],
                    'address'               => $addressSnapshot,
                    'order_source'          => 'Admin Panel',
                    'area'                  => $area->name ?? '',
                    'delivery_instruction'  => $validated['delivery_instruction'] ?? null,
                    'total_amount'          => $summary['sub_total'],
                    'discount'              => $summary['discount'],
                    'coupon_code'           => $summary['coupon_code'],
                    'coupon_discount'       => $summary['coupon_discount'],
                    'after_discount_amount' => $summary['after_discount'],
                    'delivery_charges'      => $summary['delivery_fee'],
                    'platform_fee'          => $summary['platform_fee'],
                    'grand_total'           => $summary['order_total'],
                    'payment_type'          => $validated['payment_type'],
                    'image_payment_slip'    => $paymentSlipPath,
                    'status'                => 'Pending',
                ]);

                // Generate Real Order Number
                $order->order_no = 100000000 + $order->id;
                $order->save();

                // Order Items & Stock Decrement
                foreach ($cartItems as $productId => $item) {
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

                // Increment Coupon Usage
                if ($coupon) {
                    $coupon->increment('used_count');
                }

                return $order;
            });
        } catch (ValidationException $e) {
            return back()->with('error', collect($e->errors())->flatten()->first());
        } catch (Throwable $e) {
            Log::error('Order placement failed', [
                'user_id' => auth('web')->id(),
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Something went wrong while placing your order. Please try again.');
        }

        // 7. Clear Session & Return
        session()->forget('applied_coupon');
        return redirect()->route('manager.order.filter')->with('success', 'Order placed successfully.');
    }
}
