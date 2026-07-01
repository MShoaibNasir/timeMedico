<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {


        $query = Category::latest();
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
        $classes = $query->paginate(10);
        return view('backend.category.index', compact('classes'));
    }

    public function create()
    {
        $departments = Department::where('status', 1)->get();
        return view('backend.category.create', ['departments' => $departments]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required|boolean',
            'department_id' => 'required',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        category::create([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('manager.category.index')
            ->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $departments = Department::where('status', 1)->get();
        $category = category::with('department')->findOrFail($id);
        return view('backend.category.edit', compact('category', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $class = category::with('department')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imagePath = $class->image;

        if ($request->hasFile('image')) {

            if ($class->image && Storage::disk('public')->exists($class->image)) {
                Storage::disk('public')->delete($class->image);
            }

            $imagePath = $request->file('image')->store('category', 'public');
        }

        $class->update([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('manager.category.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $class = category::findOrFail($id);

        if ($class->image && Storage::disk('public')->exists($class->image)) {
            Storage::disk('public')->delete($class->image);
        }

        $class->delete();

        return redirect()->route('manager.category.index')
            ->with('success', 'Category deleted successfully');
    }

    // 🔥 OPTIONAL: quick toggle active/inactive
    public function toggleStatus($id)
    {
        $class = category::findOrFail($id);

        $class->status = !$class->status;
        $class->save();

        return back()->with('success', 'Status updated successfully');
    }
}
