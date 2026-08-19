<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderNotificationService
{
    public static function messagesFor(string $status, Order $order): array
    {
        $orderNo = $order->customerOrderNo();

        return match ($status) {
            'Pending' => [
                'title' => 'Order Placed',
                'body' => "Your order {$orderNo} has been placed successfully and is awaiting processing.",
            ],
            'Processing' => [
                'title' => 'Order Processing',
                'body' => "Your order {$orderNo} has been approved and is now being processed.",
            ],
            'On The way' => [
                'title' => 'Order On The Way',
                'body' => "Good news! Your order {$orderNo} is on the way.",
            ],
            'Delivered' => [
                'title' => 'Order Delivered',
                'body' => "Your order {$orderNo} has been delivered. Thank you for shopping with TimeMedico.",
            ],
            'Rejected' => [
                'title' => 'Order Rejected',
                'body' => "Unfortunately, your order {$orderNo} has been rejected. Please contact support if you need help.",
            ],
            'Returned' => [
                'title' => 'Order Returned',
                'body' => "Your order {$orderNo} has been marked as returned.",
            ],
            default => [
                'title' => 'Order Update',
                'body' => "Your order {$orderNo} status is now: {$status}.",
            ],
        };
    }

    public static function notifyStatusChange(Order $order, ?string $previousStatus = null): ?Notification
    {
        try {
            $status = (string) $order->status;
            if ($previousStatus !== null && $previousStatus === $status) {
                return null;
            }

            $user = $order->relationLoaded('user')
                ? $order->user
                : ($order->user_id ? User::find($order->user_id) : null);

            if (! $user) {
                return null;
            }

            $copy = self::messagesFor($status, $order);

            $url = null;
            try {
                $url = route('frontend.dashboard.orderDetail', encrypt($order->id));
            } catch (Throwable $e) {
                $url = null;
            }

            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => 'order_status',
                'title' => $copy['title'],
                'any_relivent_message' => $status,
                'message' => $copy['body'],
                'image' => null,
                'action_type' => 'order',
                'action_id' => $order->id,
                'is_read' => false,
                'data' => [
                    'type' => 'order_status',
                    'title' => $copy['title'],
                    'body' => $copy['body'],
                    'message' => $copy['body'],
                    'order_id' => $order->id,
                    'order_no' => $order->customerOrderNo(),
                    'status' => $status,
                    'previous_status' => $previousStatus,
                    'url' => $url,
                ],
            ]);

            self::sendPush($user, $copy['title'], $copy['body'], [
                'type' => 'order',
                'id' => (string) $order->id,
                'order_id' => (string) $order->id,
                'order_no' => $order->customerOrderNo(),
                'status' => $status,
                'notification_id' => (string) $notification->id,
            ]);

            return $notification;
        } catch (Throwable $e) {
            Log::warning('Order notification failed: '.$e->getMessage(), [
                'order_id' => $order->id ?? null,
            ]);

            return null;
        }
    }

    protected static function sendPush(User $user, string $title, string $body, array $data = []): void
    {
        try {
            app(FcmService::class)->sendToUser($user, $title, $body, $data);
        } catch (Throwable $e) {
            Log::warning('FCM push failed: '.$e->getMessage(), [
                'user_id' => $user->id,
            ]);
        }
    }
}
