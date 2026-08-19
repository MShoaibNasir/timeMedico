<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if (! Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        $user = Auth::guard('web')->user();
        $notifications = $user->appNotifications()->latest()->paginate(20);

        return view('frontend.notifications', [
            'notifications' => $notifications,
        ]);
    }

    public function markRead(Request $request, $id)
    {
        if (! Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        $notification = Auth::guard('web')->user()
            ->appNotifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['status' => true]);
        }

        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllRead(Request $request)
    {
        if (! Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        Auth::guard('web')->user()
            ->appNotifications()
            ->unread()
            ->update(['is_read' => true]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['status' => true]);
        }

        return back()->with('success', 'All notifications marked as read.');
    }

    public function destroy(Request $request, $id)
    {
        if (! Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        $notification = Auth::guard('web')->user()
            ->appNotifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['status' => true, 'message' => 'Notification deleted.']);
        }

        return back()->with('success', 'Notification deleted.');
    }

    public function destroyAll(Request $request)
    {
        if (! Auth::guard('web')->check()) {
            return frontend_redirect_to_login(url()->current());
        }

        Auth::guard('web')->user()->appNotifications()->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['status' => true]);
        }

        return back()->with('success', 'All notifications deleted.');
    }
}
