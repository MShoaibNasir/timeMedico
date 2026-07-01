<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Department;
use App\Models\HomeSlider;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{

    public function index()
    {
        $sliders=HomeSlider::where('type','website')->where('status',1)->get(); 
        $departments=Department::where('status',1)->get(); 
        $tranding_items=Product::where('status',1)->where('type',10)->get();
        $featured_items=Product::where('status',1)->where('type',6)->get();
        $on_sale_items=Product::where('status',1)->where('type',12)->get();
        $best_seller_items=Product::where('status',1)->where('type',13)->get();
        $top_rated=Product::where('status',1)->where('type',14)->get();
        $polular_item_categories=Category::with('products_with_out_trashed')->where('status',1)->take(5)->latest()->get();
       
        
        return view('frontend.index')->with([
            'sliders'=>$sliders,
            'departments'=>$departments,
            'tranding_items'=>$tranding_items,
            'featured_items'=>$featured_items,
            'on_sale_items'=>$on_sale_items,
            'best_seller_items'=>$best_seller_items,
            'top_rated'=>$top_rated,
            'polular_item_categories'=>$polular_item_categories

            ]);
    }


    public function aboutUs(){
        
        return view('frontend.about');
    }


    public function singleShop(){
          return view('frontend.singleShop');
    }




  



   
}
