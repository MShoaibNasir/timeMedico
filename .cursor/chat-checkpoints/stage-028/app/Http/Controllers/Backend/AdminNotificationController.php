<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $filters = [
            'q' => $request->get('q', ''),
            'type' => $request->get('type', ''),
            'priority' => $request->get('priority', ''),
            'is_read' => $request->get('is_read', ''),
        ];

        $query = AdminNotification::query()
            ->where('admin_id', $admin->id)
            ->latest('id');

        if ($filters['q'] !== '') {
            $term = trim($filters['q']);
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('message', 'like', "%{$term}%");
            });
        }

        if ($filters['type'] !== '') {
            $query->where('type', $filters['type']);
        }

        if ($filters['priority'] !== '') {
            $query->where('severity', $filters['priority']);
        }

        if ($filters['is_read'] !== '') {
            $query->where('is_read', (int) $filters['is_read'] === 1);
        }

        $notifications = $query->paginate(40)->withQueryString();

        $types = AdminNotification::query()
            ->where('admin_id', $admin->id)
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        $unreadCount = AdminNotification::query()
            ->where('admin_id', $admin->id)
            ->unread()
            ->count();

        return view('backend.admin-notifications.index', compact(
            'notifications',
            'filters',
            'types',
            'unreadCount'
        ));
    }

    public function show($id)
    {
        $item = AdminNotification::query()
            ->where('admin_id', Auth::guard('admin')->id())
            ->findOrFail($id);

        $item->markAsRead();

        if ($item->action_url) {
            return redirect()->to($item->action_url);
        }

        return view('backend.admin-notifications.show', compact('item'));
    }

    public function markRead($id)
    {
        $item = AdminNotification::query()
            ->where('admin_id', Auth::guard('admin')->id())
            ->findOrFail($id);

        $item->markAsRead();

        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllRead()
    {
        AdminNotification::query()
            ->where('admin_id', Auth::guard('admin')->id())
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return back()->with('success', 'All notifications marked as read.');
    }

    public function destroy($id)
    {
        $item = AdminNotification::query()
            ->where('admin_id', Auth::guard('admin')->id())
            ->findOrFail($id);

        $item->delete();

        return back()->with('success', 'Notification deleted.');
    }
}
