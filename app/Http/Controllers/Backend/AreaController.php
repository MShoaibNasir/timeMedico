<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AreaBulkRequest;
use App\Models\Area;
use Auth;
use Illuminate\Http\Request;
use App\Services\AreaServices;
use Illuminate\Support\Facades\Storage;

class AreaController extends Controller
{
    protected AreaServices $areaServices;
    public function __construct(AreaServices $areaServices)
    {
        $this->areaServices = $areaServices;
    }

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
            'status' => 'required',
            'is_service_able' => 'required|in:0,1',

        ]);

        Area::create([
            'name' => $request->name,
            'delivery_charges' => $request->delivery_charges,
            'status' => $request->status,
            'is_service_able' => $request->is_service_able,
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
            'status' => 'required',
            'is_service_able' => 'required|in:0,1',

        ]);



        $area->update([
            'name' => $request->name,
            'delivery_charges' => $request->delivery_charges,
            'status' => $request->status,
            'is_service_able' => $request->is_service_able,
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

    public function UpdateBulkPrice(AreaBulkRequest $request)
    {
        $data = $request->all();
        $bulk_update = $this->areaServices->UpdateBulkPrice($data);
        if ($bulk_update['success']) {
            return redirect()->back()->with(['success' => 'Price Update Successfully!']);
        } else {
            return redirect()->back()->with(['error' => $bulk_update['message']]);
        }
    }
}
