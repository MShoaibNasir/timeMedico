<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'used_count',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'status'     => 'boolean',
    ];

    /**
     * Coupon abhi valid hai ya nahi - expiry, status, usage limit sab check.
     */
    public function isValid(): bool
    {
        if (! $this->status) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Diye gaye subtotal par kitna discount banta hai - fixed ya percent dono handle karta hai.
     */
    public function calculateDiscount(float $subTotal): float
    {
        if ($subTotal < $this->min_order_amount) {
            return 0;
        }

        if ($this->type === 'percent') {
            $discount = $subTotal * ($this->value / 100);

            if ($this->max_discount_amount !== null) {
                $discount = min($discount, $this->max_discount_amount);
            }

            return round($discount, 2);
        }

        // fixed amount - lekin subtotal se zyada discount nahi ho sakta
        return round(min($this->value, $subTotal), 2);
    }
}