<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Area;
use Illuminate\Support\Facades\Storage;

class AreaController extends Controller
{
    public function index(Request $request)
    {


        $query = Area::latest();
        $classes = $query->paginate(10);
        return view('backend.area.index', compact('classes'));
    }

    public function create()
    {

        return view('backend.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'delivery_charges' => 'required',
            'status' => 'required'
        ]);

        Area::create([
            'name' => $request->name,
            'delivery_charges' => $request->delivery_charges,
            'status' => $request->status
        ]);

        return redirect()->route('manager.area.index')
            ->with('success', 'Area created successfully');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('backend.area.edit', compact('area'));
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'delivery_charges' => 'required',
            'status' => 'required'
        ]);



        $area->update([
            'name' => $request->name,
            'delivery_charges' => $request->delivery_charges,
            'status' => $request->status,
        ]);

        return redirect()->route('manager.area.index')
            ->with('success', 'Area updated successfully');
    }

    public function destroy($id)
    {
        $class = Area::findOrFail($id);
        $class->delete();

        return redirect()->route('manager.area.index')
            ->with('success', 'Area deleted successfully');
    }

  
}
