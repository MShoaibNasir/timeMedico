<?php

use App\Services\CartService;

if (! function_exists('money')) {
    /**
     * Short helper for currency formatting - "Rs. 345.00"
     * Usage: money(345) instead of \App\Services\CartService::format(345)
     */
    function money(float $amount): string
    {
        return CartService::format($amount);
    }
}