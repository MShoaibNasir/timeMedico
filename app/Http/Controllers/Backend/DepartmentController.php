<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
     
        
        $query = Department::latest();
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
        return view('backend.department.index', compact('classes'));
    }

    public function create()
    {
        return view('backend.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('department', 'public');
        }
      
        Department::create([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('manager.department.index')
            ->with('success', 'Department created successfully');
    }

    public function edit($id)
    {
        $class = Department::findOrFail($id);
        return view('backend.department.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = Department::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:2048',
            'status' => 'required|boolean',
        ]);

        $imagePath = $class->image;

        if ($request->hasFile('image')) {

            if ($class->image && Storage::disk('public')->exists($class->image)) {
               // Storage::disk('public')->delete($class->image);
            }

            $imagePath = $request->file('image')->store('department', 'public');
        }

        $class->update([
            'name' => $request->name,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('manager.department.index')
            ->with('success', 'Department updated successfully');
    }

    public function destroy($id)
    {
        $class = Department::findOrFail($id);

        if ($class->image && Storage::disk('public')->exists($class->image)) {
            Storage::disk('public')->delete($class->image);
        }

        $class->delete();

        return redirect()->route('manager.department.index')
            ->with('success', 'Department deleted successfully');
    }

    // 🔥 OPTIONAL: quick toggle active/inactive
    public function toggleStatus($id)
    {
        $class = Department::findOrFail($id);
    
        $class->status = !$class->status;
        $class->save();

        return back()->with('success', 'Status updated successfully');
    }
}
