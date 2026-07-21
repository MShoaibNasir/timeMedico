<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\Product;

class BrandsController extends Controller
{


    public function show($id)
    {
        $product=Product::where('brand_id',$id)->where('status',1)->get();
        $brand=Brand::where('id',$id)->first();
        return view('frontend.brand',['product'=>$product,'brand'=>$brand]);
    }
}
