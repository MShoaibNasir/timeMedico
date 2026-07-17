<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function list(Request $request)
    {

        $query = Brand::latest();
        if ($request->has('export')) {

            $filename = 'Policies-Category.csv';
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
            ];
            $classes = $query->get();
            $callback = function () use ($classes) {

                $file = fopen('php://output', 'w');
                // Header row
                fputcsv($file, ['Name', 'status']);
                foreach ($classes as $data) {
                    fputcsv($file, [
                        ucwords($data->name),
                        $data->status == 1 ? 'Active' : 'In active'
                    ]);
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        }
        $blogs = $query->paginate(10);
        return view('backend.brand.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.brand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required|boolean',
            'description' => 'required|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brand', 'public');
        }

        Brand::create([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('manager.brand.list')
            ->with('success', 'Brand created successfully');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $class = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required|boolean',
            'description' => 'required|string',
        ]);

        $imagePath = $class->image;

        if ($request->hasFile('image')) {

            if ($class->image && Storage::disk('public')->exists($class->image)) {
                Storage::disk('public')->delete($class->image);
            }

            $imagePath = $request->file('image')->store('brand', 'public');
        }

        $class->update([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('manager.brand.list')
            ->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        $class = Brand::findOrFail($id);

        if ($class->image && Storage::disk('public')->exists($class->image)) {
            Storage::disk('public')->delete($class->image);
        }

        $class->delete();

        return redirect()->route('manager.brand.list')
            ->with('success', 'Brand deleted successfully');
    }

    // 🔥 OPTIONAL: quick toggle active/inactive
    public function toggleStatus($id)
    {
        $class = Brand::findOrFail($id);
        $class->status = !$class->status;
        $class->save();
        return back()->with('success', 'Status updated successfully');
    }
}
