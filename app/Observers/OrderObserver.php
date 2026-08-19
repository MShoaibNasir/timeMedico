<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\AdminNotificationService;
use App\Services\OrderNotificationService;

class OrderObserver
{
    public function created(Order $order): void
    {
        if (Order::isTemporaryNumber((string) $order->order_no)) {
            return;
        }

        $this->notifyNewOrder($order);
    }

    public function updated(Order $order): void
    {
        if ($order->wasChanged('order_no')) {
            $old = (string) $order->getOriginal('order_no');
            $new = (string) $order->order_no;
            if (Order::isTemporaryNumber($old) && ! Order::isTemporaryNumber($new)) {
                $this->notifyNewOrder($order);
            }
        }

        if ($order->wasChanged('status')) {
            OrderNotificationService::notifyStatusChange(
                $order,
                $order->getOriginal('status')
            );
        }

        if ($order->wasChanged('image_payment_slip') && ! empty($order->image_payment_slip)) {
            AdminNotificationService::paymentSlipUploaded($order);
        }
    }

    protected function notifyNewOrder(Order $order): void
    {
        OrderNotificationService::notifyStatusChange($order, null);
        AdminNotificationService::newOrder($order);
    }
}
