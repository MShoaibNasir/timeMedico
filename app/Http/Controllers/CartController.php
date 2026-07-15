<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
    public function index(): View
    {
        $cart = session('cart', []);
        $coupon = $this->resolveCoupon();
        $cartService = new CartService($cart, $coupon);

        return view('frontend.cart', ['cartItems' => $cart,'summary'   => $cartService->summary(),]);
    }
	
	
	public function addToCart(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return response()->json([
                'status' => true,
                'message' => 'Please login first.'
            ]);
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
                'discount'    => $product->discount_amount,
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
    public function update(Request $request, int $productId): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ]);
		
		//dd($request->all());

        $cart = session('cart', []);

        if (! isset($cart[$productId])) {
            return back()->with('error', 'This product is not in your cart.');
        }

        $product = Product::find($productId);

        if (! $product || $product->status !== 1) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
            return back()->with('error', 'This product is no longer available and has been removed from your cart.');
        }

        if (isset($product->stock) && $validated['quantity'] > $product->stock) {
            return back()->with('error', "Only {$product->stock} items are available in stock.");
        }

        $cart[$productId]['quantity'] = $validated['quantity'];
        $cart[$productId]['price']    = $product->price;
        $cart[$productId]['discount'] = $product->discount_amount;

        session(['cart' => $cart]);

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
	
	public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        return view('frontend.checkout', ['cart' => $cart, 'total' => $total]);
    }
}