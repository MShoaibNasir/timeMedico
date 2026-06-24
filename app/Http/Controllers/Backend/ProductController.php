<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Auth;

class ProductController extends Controller
{


    public function index()
    {
        $productes = Product::with('category')->latest()->get();
        return view('backend.product.index', compact('productes'));
    }


    public function filter()
    {
        $Classes = Category::latest()->get();
        return view('backend.product.filter', compact('Classes'));
    }




    public function list(Request $request)
    {


        $page = $request->get('ayis_page', 1);
        $qty = $request->get('qty', 10);

        $sorting = $request->get('sorting', 'id');
        $order = $request->get('direction', 'desc');

        $category_id = $request->get('main_class');
        $product_name = $request->get('product_name');
        $custom_pagination_path = '';

        $product = Product::query();

        if (!empty($category_id)) {
            $product->where('category_id', $category_id);
        }
        if (!empty($product_name)) {
            $product->where('name', 'like', '%' . $product_name . '%');
        }

        $allowedSorts = ['id', 'name', 'price', 'created_at'];
        if (in_array($sorting, $allowedSorts)) {
            $product->orderBy($sorting, $order === 'asc' ? 'asc' : 'desc');
        } else {
            $product->orderBy('id', 'desc');
        }

        $data = $product->paginate($qty, ['*'], 'page', $page)->setPath($custom_pagination_path);

        return view('backend.product.index', ['data' => $data]);
    }


    public function create()
    {
        $classes = Category::where('status', 1)->get();
        return view('backend.product.create', compact('classes'));
    }
    public function store(Request $request)
    {


        $request->validate([
            'category_id' => 'required',
            'name'        => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status'      => 'required|boolean',
            'sku'         => 'required',
            'price'       => 'required',
            'discount'  => 'required',
            'quantity'    => 'required',
          
            'company_name'    => 'required',

        ]);
        $in_stock = $request->in_stock;
        if ($in_stock == 'on' && isset($in_stock)) {
            $in_stock = 1;
        }else{
            $in_stock = 0;
        }

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('productes', 'public');
        }

        // Generate Barcode
        // $barcode = now()->format('ymdHis') . rand(100, 999);

        product::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'image'        => $imagePath,
            'status'      => $request->status,
            'sku'         => $request->sku,
            'discount'     => $request->discount,
            'product_description'     => $request->product_description ?? null,
            'price'       => $request->price,
            'in_stock'  => $in_stock,
            'quantity'    => $request->quantity,
            'company_name'    => $request->company_name ?? null,
            'admin_id'    => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('manager.product.filter')
            ->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $category = Category::where('status', 1)->get();

        return view('backend.product.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name'        => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status'      => 'required|boolean',
            'sku'         => 'required',
            'price'       => 'required',
            'discount'  => 'required',
            'quantity'    => 'required',
            'company_name'    => 'required',
        ]);


        $imagePath = $product->image;

        if ($request->hasFile('image')) {

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('productes', 'public');
        }
        $in_stock = $request->in_stock;
        if ($in_stock == 'on' && isset($in_stock)) {
            $in_stock = 1;
        } else {
            $in_stock = 0;
        }


        $product->update([
            'category_id' => $request->category_id,
            'name'     => $request->name,
            'image'     => $imagePath,
            'status'   => $request->status,
            'sku'         => $request->sku,
            'price'       => $request->price,
            'cost_price'  => $request->cost_price,
            'quantity'    => $request->quantity,
            'discount'     => $request->discount,
            'company_name'    => $request->company_name ?? null,
            'product_description' => $request->product_description ?? null,
            'in_stock'  => $in_stock,
        ]);

        return redirect()->route('manager.product.filter')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('manager.product.filter')
            ->with('success', 'Product deleted successfully');
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();

        return back()->with('success', 'Status updated successfully');
    }
}
