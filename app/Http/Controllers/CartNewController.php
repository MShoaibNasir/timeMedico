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