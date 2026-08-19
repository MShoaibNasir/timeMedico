<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DeviceTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $notifications = $user->appNotifications()->latest()->paginate(30);

        return response()->json([
            'status' => true,
            'unread_count' => $user->unreadAppNotifications()->count(),
            'data' => $notifications->getCollection()->map(function ($n) {
                $data = is_array($n->data) ? $n->data : [];
                $orderNo = $n->displayOrderNo();
                $body = $n->displayMessage();
                $data['order_no'] = $orderNo;
                $data['body'] = $body;
                $data['message'] = $body;

                return [
                    'id' => $n->id,
                    'title' => $n->title ?: ($data['title'] ?? 'Notification'),
                    'body' => $body,
                    'type' => $n->type ?: ($data['type'] ?? null),
                    'order_id' => $n->action_type === 'order' ? $n->action_id : ($data['order_id'] ?? null),
                    'order_no' => $orderNo,
                    'status' => $n->any_relivent_message ?: ($data['status'] ?? null),
                    'is_read' => (bool) $n->is_read,
                    'read_at' => $n->is_read ? optional($n->updated_at)?->toDateTimeString() : null,
                    'created_at' => optional($n->created_at)?->toDateTimeString(),
                    'data' => $data,
                ];
            }),
            'meta' => [
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'total' => $notifications->total(),
            ],
        ]);
    }

    public function markRead(Request $request, $id): JsonResponse
    {
        $notification = $request->user()->appNotifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();

        return response()->json(['status' => true]);
    }

    public function markAllRead(Request $request): JsonResponse
    {
        $request->user()->appNotifications()->unread()->update(['is_read' => true]);

        return response()->json(['status' => true]);
    }

    public function updateFcmToken(Request $request): JsonResponse
    {
        $request->validate([
            'fcmToken' => 'required|string',
            'deviceId' => 'nullable|string',
            'phoneModel' => 'nullable|string',
            'phoneMake' => 'nullable|string',
            'appVersion' => 'nullable|string',
        ]);

        $user = $request->user();
        DeviceTokenService::register($user, $request->fcmToken, $request->deviceId, [
            'phoneModel' => $request->phoneModel,
            'phoneMake' => $request->phoneMake,
            'appVersion' => $request->appVersion,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'FCM token updated successfully.',
        ]);
    }
}
