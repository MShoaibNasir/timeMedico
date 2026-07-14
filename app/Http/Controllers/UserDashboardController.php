<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserDashboardController extends Controller
{

    public function show(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->back()->with(['info' => 'Please log in before proceeding.']);
        }
        $user_id = Auth::guard('web')->user()->id;
        $completed_orders = Order::where('status', 'Delivered')->where('user_id', $user_id)->count();
        $pending_orders   = Order::where('status', 'Pending')->where('user_id', $user_id)->count();
        $return_orders    = Order::where('status', 'Returned')->where('user_id', $user_id)->count();
        $orders = Order::where('user_id', $user_id)->take(5)->latest()->get();
        return view('frontend.UserDashboard', [
            'completed_orders' => $completed_orders,
            'pending_orders' => $pending_orders,
            'return_orders' => $return_orders,
            'orders' => $orders,
        ]);
    }
    public function profile(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->back()->with(['info' => 'Please log in before proceeding.']);
        }
        $id = Auth::guard('web')->user()->id;
        $user = User::where('id', $id)->first();

        return view('frontend.profile', ['user' => $user]);
    }
    public function orderlist(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->back()->with(['info' => 'Please log in before proceeding.']);
        }
        $user_id = Auth::guard('web')->user()->id;
        $orders = Order::where('user_id', $user_id)->latest()->get();

        return view('frontend.order', ['orders' => $orders]);
    }
    public function trackingOrder(Request $request)
    {
        return view('frontend.trackmyorder');
    }
    public function trackOrder(Request $request)
    {
        $order = null;
        if ($request->filled('order_no')) {
            $order = Order::where('order_no', $request->order_no)->first();
        }
        return view('components.trackOrder', compact('order'));
    }
    public function orderDetail(Request $request, $id)
    {
        $id = decrypt($id);
        $order = Order::with(['items.product'])->findOrFail($id);
        return view('frontend.order-detail', compact('order'));
    }
    public function updateProfile(Request $request)
    {

        $data = $request->all();
        $imagePath = null;
        $path = 'profileImage';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store($path, 'public');
        }
        $user_id = Auth::guard('web')->user()->id;
        User::where('id', $user_id)->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'image' => $imagePath
        ]);
        return redirect()->back()->with('success', 'Profile Update Successfully!');
    }
}
