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
                    'quantity',
                    'price',
                    'company_name',
                    'in_stock',
                    'discount'
                )
                ->latest()
                ->limit(15);
        }])->get();



        $data = $types->map(function ($type) {
            return [
                'id'       => $type->id,
                'title'    => $type->name,
                'type'     => strtolower(str_replace(' ', '_', $type->name)),
                'products' => $type->product_with_out_trashed->map(function ($product) {
                    return [
                        'id'    => $product->id,
                        'name'  => $product->name,
                        'price' => number_format($product->price, 2),
                        'image' => $product->image,
                        'stock' => (bool) $product->in_stock,
                        'quantity' => $product->quantity,
                        'discount' => $product->discount,
                        'discount_amount' => $product->discount_amount,
                        'final_price' => $product->final_price,
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
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = Product::with('category', 'reviews')
            ->where('id', $request->id)
            ->select(
                'id',
                'name',
                'generic_name',
                'category_id',
                'rating',
                'company_name as brand_name',
                'image',
                'price',
                'quantity',
                'company_name',
                'in_stock',
                'product_description',
                'discount',
                'sku'
            )
            ->first();

        if ($data) {
            $data->price = number_format($data->price, 2, '.', '');
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }


    public function data(Request $request)
    {
        $perPage = $request->input('per_page', 1);

        $products = Product::with('category')->where('status', 1);

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
    public function productDataWithRespectType(Request $request)
    {
        $perPage = $request->input('per_page', 1);
        $products = Product::with('category')->where('status', 1)->latest();
        if ($request->filled('type_id')) {
            $products->where('type', $request->type_id);
        }

        $products = $products->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'Products fetched successfully',
            'data' => $products
        ]);
    }

    public function search(Request $request)
    {
        $perPage = $request->input('per_page', 1);
        $products = Product::with('category')->where('status', 1);

        if ($request->filled('category_id')) {
            $products->where('category_id', $request->category_id);
        }
        if ($request->filled('name')) {
            $search = trim($request->name);

            $products->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            });
        }
        $products = $products->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'Products fetched successfully',
            'data' => $products
        ]);
    }
    public function typeSearch(Request $request)
    {
        $perPage = $request->input('per_page', 1);
        $products = Product::with('category')->where('status', 1);

        if ($request->filled('type_id')) {
            $products->where('type', $request->type_id);
        }

        if ($request->filled('name')) {
            $search = trim($request->name);

            $products->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            });
        }
        $products = $products->paginate($perPage);
        return response()->json([
            'success' => true,
            'message' => 'Products fetched successfully',
            'data' => $products
        ]);
    }
}
