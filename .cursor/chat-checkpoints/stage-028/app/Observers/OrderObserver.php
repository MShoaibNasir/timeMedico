<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\AdminNotificationService;
use App\Services\OrderNotificationService;

class OrderObserver
{
    public function created(Order $order): void
    {
        OrderNotificationService::notifyStatusChange($order, null);
        AdminNotificationService::newOrder($order);
    }

    public function updated(Order $order): void
    {
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
}
