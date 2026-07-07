<?php

namespace App\Http\Controllers\API;


use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends BaseController
{




    public function index(Request $request)
    {

        $types = Type::with(['product_with_out_trashed' => function ($query) {
            $query->where('status', 1)
                ->select(
                    'id',
                    'type',
                    'name',
                    'image',
                    'price',
                    'company_name',
                    'in_stock'
                )
                ->latest()
                ->limit(15);
        }])->get();



        $data = $types->map(function ($type) {
            return [
                'id'       => $type->id,
                'title'    => $type->name,
                'type'     => strtolower(str_replace(' ', '_', $type->name)),
                'products' => $type->product->map(function ($product) {
                    return [
                        'id'    => $product->id,
                        'name'  => $product->name,
                        'price' => $product->price,
                        'image' => $product->image,
                        'stock' => (bool) $product->in_stock,
                    ];
                }),
            ];
        });

        return response()->json([
            'status' => true,
            'data'   => $data,
        ]);
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
        $data = Product::where('id', $request->id)->select('id', 'name', 'image', 'price', 'quantity', 'company_name', 'in_stock', 'product_description', 'discount')->first();
        return $data;
    }


public function data(Request $request)
{
    $perPage = $request->input('per_page', 1);

    $products = Product::where('status', 1);

    if ($request->filled('category_id')) {
        $products->where('category_id', $request->category_id);
    }

    $products = $products->paginate($perPage);

    return response()->json([
        'status' => true,
        'message' => 'Products fetched successfully',
        'data' => $products
    ]);
}




}
