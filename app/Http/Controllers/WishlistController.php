<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{


    public function add(Request $request)
    {
        $productId = $request->product_id;

        $wishlist = session()->get('wishlist', []);

        if (($key = array_search($productId, $wishlist)) !== false) {

            // Remove from wishlist
            unset($wishlist[$key]);

            // Re-index array
            $wishlist = array_values($wishlist);

            $message = 'Product removed from wishlist';
            $action = 'removed';
        } else {


            $wishlist[] = $productId;
            $message = 'Product added to wishlist';
            $action = 'added';
        }

        session()->put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'action' => $action,
            'message' => $message,
            'wishlist_count' => count($wishlist)
        ]);
    }


    public function show(Request $request)
    {
        $wishlist = session()->get('wishlist', []);
        $count_wishlist = count($wishlist);
        return view('frontend.Components.wishlist', ['wishlist' => $wishlist, 'count_wishlist' => $count_wishlist]);
    }
    public function WishList(Request $request)
    {

        return view('frontend.WishList');
    }

    public function product_list()
    {
        $wishlist = session()->get('wishlist', []);
     
        $products = Product::with('category')
            ->where('status', 1)
            ->whereIn('id', $wishlist)
            ->latest()
            ->paginate(12);
        $count_wishlist = count($wishlist);
        return view('frontend.Components.wishlist_product', ['products' => $products]);
    }
}
