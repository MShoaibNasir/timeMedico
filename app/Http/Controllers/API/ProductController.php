<?php

namespace App\Http\Controllers\API;


use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends BaseController
{



    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id'  => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $data = Product::where('status', 1)->where('category_id',$request->category_id)->select('id','name', 'image','price','company_name','in_stock')->get();
        return $data;
    }

    public function detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'  => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $data = Product::where('id',$request->id)->select('id','name', 'image','price','quantity','company_name','in_stock','product_description','discount')->get();
        return $data;
    }
}
