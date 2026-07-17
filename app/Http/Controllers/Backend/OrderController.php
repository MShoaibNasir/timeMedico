<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{
    public function filter(Request $request)
    {
        return view('backend.orders.filter');
    }
    public function list(Request $request)
    {
        $page = $request->get('page', 1);
        $qty  = $request->get('qty', 10);

        $orders = Order::query();

        // Order No
        if ($request->filled('order_no')) {
            $orders->where('order_no', 'LIKE', '%' . $request->order_no . '%');
        }

        // Date
        if ($request->filled('order_date')) {
            $orders->whereDate('created_at', $request->order_date);
        }

        // Customer Name OR Phone
        if ($request->filled('customer_search')) {
            $search = $request->customer_search;

            $orders->where(function ($q) use ($search) {
                $q->where('customer_name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Status
        if ($request->filled('status')) {
            $orders->where('status', $request->status);
        }

        $orders = $orders->latest()
            ->paginate($qty, ['*'], 'page', $page);

        return view('backend.orders.list', [
            'data' => $orders
        ]);
    }

    public function view($id)
    {
        $id = decrypt($id);
        $order = Order::with(['items.product'])->findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,On The way,Delivered,Rejected,Returned',
        ]);

        $order = Order::findOrFail($id);
        
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
