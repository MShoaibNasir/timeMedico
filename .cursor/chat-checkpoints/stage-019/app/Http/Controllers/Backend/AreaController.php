<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Area;
use Illuminate\Support\Facades\DB;
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

    /**
     * Apply delivery charge change to all (or active) areas at once.
     * Modes: increase | decrease | set
     */
    public function bulkDeliveryCharges(Request $request)
    {
        $validated = $request->validate([
            'mode'   => 'required|in:increase,decrease,set',
            'amount' => 'required|numeric|min:0',
            'scope'  => 'required|in:all,active',
        ]);

        $amount = round((float) $validated['amount'], 2);
        $query = Area::query();

        if ($validated['scope'] === 'active') {
            $query->where('status', 1);
        }

        $count = (clone $query)->count();

        if ($count === 0) {
            return redirect()->route('manager.area.index')
                ->with('error', 'No areas found to update.');
        }

        if ($validated['mode'] === 'increase') {
            $query->increment('delivery_charges', $amount);
            $message = "Added Rs {$amount} to delivery charges for {$count} area(s).";
        } elseif ($validated['mode'] === 'decrease') {
            DB::table('area')
                ->when($validated['scope'] === 'active', fn ($q) => $q->where('status', 1))
                ->update([
                    'delivery_charges' => DB::raw('GREATEST(CAST(delivery_charges AS DECIMAL(12,2)) - ' . $amount . ', 0)'),
                ]);
            $message = "Reduced Rs {$amount} from delivery charges for {$count} area(s) (min 0).";
        } else {
            $query->update([
                'delivery_charges' => $amount,
            ]);
            $message = "Set delivery charges to Rs {$amount} for {$count} area(s).";
        }

        return redirect()->route('manager.area.index')
            ->with('success', $message);
    }
}
