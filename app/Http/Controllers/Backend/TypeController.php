<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{


    public function create()
    {
        return view('backend.type.create');
    }

    public function index(Request $request)
    {

        $classes = Type::latest()->get();
        return view('backend.type.index', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Type::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('manager.type.index')
            ->with('success', 'Type Created successfully');
    }

    public function edit($id)
    {
        $type = Type::where('id',$id)->first();
    
        return view('backend.type.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $Type = Type::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);



        $Type->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('manager.type.index')
            ->with('success', 'Type updated successfully');
    }

    public function destroy($id)
    {
        $class = Type::findOrFail($id);

        if ($class->image && Storage::disk('public')->exists($class->image)) {
            Storage::disk('public')->delete($class->image);
        }

        $class->delete();

        return redirect()->route('manager.type.index')
            ->with('success', 'Type deleted successfully');
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
