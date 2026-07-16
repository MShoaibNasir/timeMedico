<script src="{{ asset('frontend/js/cart.js') }}"></script>

Header
======
<a href="{{ route('cart') }}">
    Cart
    <span class="cart-count">
        {{ collect(session('cart',[]))->sum('quantity') }}
    </span>
</a>

Mini Cart Header
================
<div class="site-cart">
    @include('frontend.includes.minicart')
</div>


Form Ab form sirf itna hoga.
=============================
<form class="add-to-cart-form" action="{{ route('ajax.cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">Add To Cart</button>
</form>



resources/views/frontend/includes/minicart.blade.php
=======================================================
<a href="{{ route('cart') }}" class="shop-cart list-item">

    <div class="list-item-icon">
        <i class="far fa-shopping-bag"></i>

        <span class="cart-count">
            {{ collect($cart)->sum('quantity') }}
        </span>

    </div>

    <div class="list-item-info">

        <h6 class="cart-total">
            Rs {{ number_format($total,2) }}
        </h6>

        <h5>My Cart</h5>

    </div>

</a>

<div class="dropdown-cart-menu">

    <div class="dropdown-cart-header">

        <span>
            {{ collect($cart)->sum('quantity') }} Items
        </span>

        <a href="{{ route('cart') }}">
            View Cart
        </a>

    </div>


    <ul class="dropdown-cart-list">

        @forelse($cart as $item)

        <li>

            <div class="dropdown-cart-item">

                <div class="cart-img">

                    <a href="{{ route('frontend.singleShop',Crypt::encryptString($item['id'])) }}">

                        <img src="{{ asset('storage/'.$item['image']) }}"
                             alt="{{ $item['name'] }}">

                    </a>

                </div>


                <div class="cart-info">

                    <h4>

                        <a href="{{ route('frontend.singleShop',Crypt::encryptString($item['id'])) }}">

                            {{ $item['name'] }}

                        </a>

                    </h4>

                    <div class="cart-qty-wrapper">

                        <button
                            class="btn btn-sm btn-light cart-minus"
                            data-id="{{ $item['id'] }}">

                            -

                        </button>


                        <input
                            type="text"
                            readonly
                            class="cart-qty-input"
                            value="{{ $item['quantity'] }}">


                        <button
                            class="btn btn-sm btn-light cart-plus"
                            data-id="{{ $item['id'] }}">

                            +

                        </button>

                    </div>


                    <div class="mt-1">

                        <strong>

                            Rs
                            {{ number_format(($item['price']-$item['discount']) * $item['quantity'],2) }}

                        </strong>

                    </div>

                </div>


                <a href="javascript:void(0)"
                   class="cart-remove"
                   data-id="{{ $item['id'] }}">

                    <i class="far fa-trash-alt"></i>

                </a>

            </div>

        </li>

        @empty

        <li class="text-center py-4">

            <h6>Your cart is empty.</h6>

        </li>

        @endforelse

    </ul>



    <div class="dropdown-cart-bottom">

        <div class="dropdown-cart-total">

            <span>Total</span>

            <span class="total-amount">

                Rs {{ number_format($total,2) }}

            </span>

        </div>

        <a href="{{ route('cart') }}"
           class="theme-btn">

            View Cart

        </a>

    </div>

</div>
========================================================================

$(document).on('click','.cart-plus',function(){
    let id=$(this).data('id');
    updateCart(id,'increase');
});

$(document).on('click','.cart-minus',function(){
    let id=$(this).data('id');
    updateCart(id,'decrease');
});

$(document).on('click','.cart-remove',function(){
    let id=$(this).data('id');
    removeCart(id);
});

================================================================

use App\Http\Controllers\CartController;

Route::prefix('cart')->group(function () {

    Route::post('/add', [CartController::class,'add'])
        ->name('ajax.cart.add');

    Route::post('/update', [CartController::class,'update'])
        ->name('ajax.cart.update');

    Route::post('/remove', [CartController::class,'remove'])
        ->name('ajax.cart.remove');

    Route::get('/mini-cart', [CartController::class,'miniCart'])
        ->name('ajax.cart.minicart');

});





============================================
{{ html()->hidden('total_amount')->value(money($summary['order_total'])) }}			
@foreach($cartItems as $index => $item)
    {{ html()->hidden("items[$index][product_id]")->value($item['id']) }}
    {{ html()->hidden("items[$index][name]")->value($item['name']) }}
    {{ html()->hidden("items[$index][quantity]")->value($item['quantity']) }}
    {{ html()->hidden("items[$index][price]")->value($item['price']) }}
@endforeach	

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\Cart\AddToCartRequest;
use App\Services\CartServiceNew;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartNewController extends Controller
{
	protected CartServiceNew $cart;

    public function __construct(CartServiceNew $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Add Product To Cart
     */
	 /*
    public function add(AddToCartRequest $request): JsonResponse
    {
        if (!Auth::guard('web')->check()) {

            return response()->json([
                'success' => false,
                'message' => 'Please login first.'
            ], 401);
        }

        try {

            $cart = $this->cart->add(
                $request->product_id,
                $request->quantity ?? 1
            );

            return response()->json([
                'success' => true,
                'message' => 'Product added successfully.',
                'html' => view('frontend.includes.minicart', ['cart' => $cart['cart']])->render(),
                'cart_count' => $cart['count'],
                'subtotal' => number_format($cart['subtotal'], 2)
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to add product.',
                //'error'=>$e->getMessage()
            ],500);

        }
    }
	*/
	
	public function add(AddToCartRequest $request)
    {
        $this->cart->add($request->product_id, $request->quantity ?? 1);
        return $this->response();
    }
	

    /**
     * Increase / Decrease Quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'type' => 'required|in:increase,decrease'
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$request->product_id])) {

            return response()->json([
                'success'=>false,
                'message'=>'Product not found.'
            ]);
        }

        if ($request->type == 'increase') {

            $cart[$request->product_id]['quantity']++;

        } else {

            if ($cart[$request->product_id]['quantity'] > 1) {

                $cart[$request->product_id]['quantity']--;

            }

        }

        session()->put('cart',$cart);

        return $this->response();
		
    }

    /**
     * Remove Item
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id'=>'required'
        ]);

        $cart=session()->get('cart',[]);

        unset($cart[$request->product_id]);

        session()->put('cart',$cart);

        return $this->response();
    }

    /**
     * Mini Cart
     */
    public function miniCart()
    {
        return $this->response();
    }

    /**
     * Common Ajax Response
     */
    private function response()
    {
        $cart=session()->get('cart',[]);
        $total=collect($cart)->sum(function($item){
        return ($item['price']-$item['discount'])*$item['quantity'];
        });

        return response()->json([
            'success'=>true,
            'count'=>collect($cart)->sum('quantity'),
            'subtotal'=>number_format($total,2),
            'html'=>view('frontend.includes.minicart',compact('cart','total'))->render()
        ]);
    }


	
}