<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Blog;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function list(Request $request)
    {


        $query = Blog::latest();
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
        return view('backend.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.blog.create');
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
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('manager.blog.list')
            ->with('success', 'Blog created successfully');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('backend.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $class = Blog::findOrFail($id);

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

            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $class->update([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('manager.blog.list')
            ->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        $class = Blog::findOrFail($id);

        if ($class->image && Storage::disk('public')->exists($class->image)) {
            Storage::disk('public')->delete($class->image);
        }

        $class->delete();

        return redirect()->route('manager.blog.list')
            ->with('success', 'Blog deleted successfully');
    }

    // 🔥 OPTIONAL: quick toggle active/inactive
    public function toggleStatus($id)
    {
        $class = Blog::findOrFail($id);
        $class->status = !$class->status;
        $class->save();
        return back()->with('success', 'Status updated successfully');
    }
}
