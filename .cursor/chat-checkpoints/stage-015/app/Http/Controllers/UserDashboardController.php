<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\PaymentSlipHistory;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;

class UserDashboardController extends Controller
{

    public function show(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
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
            return frontend_redirect_to_login(url()->current());
        }
        $id = Auth::guard('web')->user()->id;
        $user = User::where('id', $id)->first();

        return view('frontend.profile', ['user' => $user]);
    }
    public function orderlist(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
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
        $order_verify_for_payment = false;
        if (isset($request->order_verify_for_payment)) {
            $order_verify_for_payment = $request->order_verify_for_payment;
        }
        if ($request->filled('order_no')) {
            $order = Order::where('order_no', $request->order_no)->first();
        }
        return view('components.trackOrder', compact('order', 'order_verify_for_payment'));
    }

    public function uploadPaymentSlip(Request $request)
    {
        $paymentSlipPath = null;
        if ($request->hasFile('image_payment_slip')) {
            $paymentSlipPath = $request->file('image_payment_slip')->store('payment-slips', 'public');
        }


        $order = Order::where('id', $request->order_id)->update(['image_payment_slip' => $paymentSlipPath, 'order_confirmed_by_admin' => 1]);
        PaymentSlipHistory::create([
            'image' => $paymentSlipPath,
            'order_id' => $request->order_id
        ]);
        return redirect()->back()->with([
            'success' => 'Thank you! Your payment slip has been submitted successfully. Once verified, your order status will be updated and you will be notified.'
        ]);
    }

    public function orderDetail(Request $request, $id)
    {
        if (!Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        $id = decrypt($id);
        $order = Order::with(['items.product'])
            ->where('user_id', Auth::guard('web')->id())
            ->findOrFail($id);

        return view('frontend.order-detail', compact('order'));
    }

    /**
     * Load a previous order into the customer cart so they can edit qty / remove items and place again.
     * Admin/backend flow is untouched — this only fills the frontend session cart.
     */
    public function reorder(Request $request, $id)
    {
        if (!Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        $orderId = decrypt($id);
        $userId = Auth::guard('web')->id();

        $order = Order::with(['items.product'])
            ->where('id', $orderId)
            ->where('user_id', $userId)
            ->firstOrFail();

        $cart = [];
        $added = 0;
        $skipped = [];

        foreach ($order->items as $item) {
            $product = $item->product;

            if (!$product || (int) $product->status !== 1) {
                $skipped[] = $item->name ?? ($product->name ?? 'Unavailable product');
                continue;
            }

            $stock = (int) ($product->quantity ?? 0);
            if ($stock <= 0) {
                $skipped[] = $product->name;
                continue;
            }

            $qty = min(max(1, (int) $item->quantity), $stock);

            $cart[$product->id] = [
                'id'              => $product->id,
                'sku'             => $product->sku,
                'name'            => $product->name,
                'unit'            => $product->unit,
                'price'           => $product->price,
                'final_price'     => $product->final_price,
                'discount'        => $product->discount,
                'discount_amount' => $product->discount_amount,
                'image'           => $product->image,
                'quantity'        => $qty,
            ];
            $added++;
        }

        if ($added === 0) {
            return redirect()
                ->route('frontend.dashboard.orderDetail', encrypt($order->id))
                ->with('error', 'No available products from this order could be added to cart.');
        }

        session(['cart' => $cart]);

        $message = 'Previous order loaded into your cart. You can update quantities, remove items, then place the order again.';
        if ($skipped !== []) {
            $message .= ' Some items were skipped: ' . implode(', ', array_slice($skipped, 0, 5));
        }

        return redirect()
            ->route('frontend.cartcheckout')
            ->with('success', $message);
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
    public function uploadPayment(Request $request)
    {
        return view('frontend.verify');
    }
}
