<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\OrderNotificationService;

class OrderObserver
{
    public function created(Order $order): void
    {
        OrderNotificationService::notifyStatusChange($order, null);
    }

    public function updated(Order $order): void
    {
        if ($order->wasChanged('status')) {
            OrderNotificationService::notifyStatusChange(
                $order,
                $order->getOriginal('status')
            );
        }
    }
}
