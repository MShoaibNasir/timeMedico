<?php

namespace App\Models\Concerns;

use App\Models\Order;

trait HidesTemporaryOrderNo
{
    public function relatedOrder(): ?Order
    {
        if ($this->action_type !== 'order' || ! $this->action_id) {
            return null;
        }

        if ($this->relationLoaded('order')) {
            return $this->order;
        }

        return Order::find($this->action_id);
    }

    public function displayOrderNo(): ?string
    {
        $data = is_array($this->data) ? $this->data : [];
        $stored = isset($data['order_no']) ? (string) $data['order_no'] : '';

        if ($stored !== '' && ! Order::isTemporaryNumber($stored)) {
            return ltrim($stored, '#');
        }

        $order = $this->relatedOrder();
        if ($order) {
            return $order->customerOrderNo();
        }

        return null;
    }

    public function displayMessage(): string
    {
        $body = (string) ($this->message ?: '');
        if ($body === '' && is_array($this->data)) {
            $body = (string) ($this->data['body'] ?? $this->data['message'] ?? '');
        }

        $real = $this->displayOrderNo();
        if ($real) {
            $body = preg_replace('/#?TEMP-[a-zA-Z0-9]+/', $real, $body) ?? $body;
        } else {
            $body = preg_replace('/\s*#?TEMP-[a-zA-Z0-9]+/', '', $body) ?? $body;
        }

        return trim(preg_replace('/\s{2,}/', ' ', $body) ?? $body);
    }
}
