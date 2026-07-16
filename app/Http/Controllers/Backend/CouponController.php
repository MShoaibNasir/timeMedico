<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $query = Coupon::latest();

        if ($request->has('export')) {

            $filename = 'Coupons.csv';

            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
            ];

            $coupons = $query->get();

            $callback = function () use ($coupons) {

                $file = fopen('php://output', 'w');

                fputcsv($file, [
                    'Code',
                    'Type',
                    'Value',
                    'Min Order Amount',
                    'Max Discount Amount',
                    'Usage Limit',
                    'Used Count',
                    'Expiry Date',
                    'Status'
                ]);

                foreach ($coupons as $coupon) {

                    fputcsv($file, [
                        $coupon->code,
                        $coupon->type,
                        $coupon->value,
                        $coupon->min_order_amount,
                        $coupon->max_discount_amount,
                        $coupon->usage_limit,
                        $coupon->used_count,
                        optional($coupon->expires_at)->format('Y-m-d H:i:s'),
                        $coupon->status ? 'Active' : 'Inactive'
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        $coupons = $query->paginate(10);

        return view('backend.coupon.index', compact('coupons'));
    }

    public function create()
    {
       
        return view('backend.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'                => 'required|string|max:255|unique:coupons,code',
            'type'                => 'required|in:fixed,percent',
            'value'               => 'required|numeric|min:0',
            'min_order_amount'    => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit'         => 'nullable|integer|min:1',
            'expires_at'          => 'nullable|date',
            'status'              => 'required|boolean',
        ]);

        Coupon::create([
            'code'                => strtoupper($request->code),
            'type'                => $request->type,
            'value'               => $request->value,
            'min_order_amount'    => $request->min_order_amount ?? 0,
            'max_discount_amount' => $request->max_discount_amount,
            'usage_limit'         => $request->usage_limit,
            'used_count'          => 0,
            'expires_at'          => $request->expires_at,
            'status'              => $request->status,
        ]);

        return redirect()->route('manager.coupon.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('backend.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code'                => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'type'                => 'required|in:fixed,percent',
            'value'               => 'required|numeric|min:0',
            'min_order_amount'    => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit'         => 'nullable|integer|min:1',
            'expires_at'          => 'nullable|date',
            'status'              => 'required|boolean',
        ]);

        $coupon->update([
            'code'                => strtoupper($request->code),
            'type'                => $request->type,
            'value'               => $request->value,
            'min_order_amount'    => $request->min_order_amount ?? 0,
            'max_discount_amount' => $request->max_discount_amount,
            'usage_limit'         => $request->usage_limit,
            'expires_at'          => $request->expires_at,
            'status'              => $request->status,
        ]);

        return redirect()->route('manager.coupon.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->delete();

        return redirect()->route('manager.coupon.index')
            ->with('success', 'Coupon deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->status = !$coupon->status;
        $coupon->save();

        return back()->with('success', 'Coupon status updated successfully.');
    }
}
