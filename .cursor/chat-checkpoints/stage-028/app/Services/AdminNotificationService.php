<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\AdminNotification;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Throwable;

class AdminNotificationService
{
    public static function notifyAll(array $payload): void
    {
        try {
            $admins = Admin::query()
                ->when(
                    \Illuminate\Support\Facades\Schema::hasColumn('admins', 'isactive'),
                    fn ($q) => $q->where(function ($q2) {
                        $q2->where('isactive', 1)->orWhereNull('isactive');
                    })
                )
                ->get(['id']);

            if ($admins->isEmpty()) {
                return;
            }

            $now = now();
            $rows = [];

            foreach ($admins as $admin) {
                $rows[] = [
                    'admin_id' => $admin->id,
                    'type' => $payload['type'] ?? 'system',
                    'title' => $payload['title'] ?? 'Notification',
                    'message' => $payload['message'] ?? '',
                    'severity' => $payload['severity'] ?? 'normal',
                    'action_type' => $payload['action_type'] ?? null,
                    'action_id' => $payload['action_id'] ?? null,
                    'action_url' => $payload['action_url'] ?? null,
                    'data' => isset($payload['data']) ? json_encode($payload['data']) : null,
                    'is_read' => false,
                    'read_at' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            AdminNotification::insert($rows);
        } catch (Throwable $e) {
            Log::warning('AdminNotificationService failed: '.$e->getMessage());
        }
    }

    public static function newOrder(Order $order): void
    {
        $orderNo = $order->order_no ?: ('#'.$order->id);
        $url = null;
        try {
            $url = route('manager.order.view', encrypt($order->id));
        } catch (Throwable $e) {
            $url = null;
        }

        self::notifyAll([
            'type' => 'new_order',
            'title' => 'New Order Received',
            'message' => "Order {$orderNo} was placed by ".($order->customer_name ?: 'a customer').' (Rs '.number_format((float) $order->grand_total, 0).').',
            'severity' => 'high',
            'action_type' => 'order',
            'action_id' => $order->id,
            'action_url' => $url,
            'data' => [
                'order_no' => $order->order_no,
                'status' => $order->status,
                'grand_total' => $order->grand_total,
                'order_source' => $order->order_source ?? null,
            ],
        ]);
    }

    public static function paymentSlipUploaded(Order $order): void
    {
        $orderNo = $order->order_no ?: ('#'.$order->id);
        $url = null;
        try {
            $url = route('manager.order.view', encrypt($order->id));
        } catch (Throwable $e) {
            $url = null;
        }

        self::notifyAll([
            'type' => 'payment_slip',
            'title' => 'Payment Slip Uploaded',
            'message' => "A payment slip was uploaded for order {$orderNo}. Please review and confirm.",
            'severity' => 'high',
            'action_type' => 'order',
            'action_id' => $order->id,
            'action_url' => $url,
            'data' => [
                'order_no' => $order->order_no,
            ],
        ]);
    }

    public static function newFeedback(Feedback $feedback): void
    {
        $url = null;
        try {
            $url = route('manager.feedback.show', $feedback->id);
        } catch (Throwable $e) {
            $url = route('manager.feedback.index');
        }

        self::notifyAll([
            'type' => 'feedback',
            'title' => 'New Customer Feedback',
            'message' => ($feedback->subject ? $feedback->subject.': ' : '').\Illuminate\Support\Str::limit((string) $feedback->message, 120),
            'severity' => 'normal',
            'action_type' => 'feedback',
            'action_id' => $feedback->id,
            'action_url' => $url,
            'data' => [
                'email' => $feedback->email,
                'user_id' => $feedback->user_id,
            ],
        ]);
    }
}
