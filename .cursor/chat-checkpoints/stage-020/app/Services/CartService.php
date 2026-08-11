<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Coupon;

class CartService
{
    public const METHOD_LOCAL = 'local';
    public const METHOD_COURIER = 'courier';
    public const METHOD_PAKISTAN = 'pakistan';

    protected array $items;
    protected ?Area $area;
    protected ?Coupon $coupon;
    protected string $deliveryMethod;

    public function __construct(
        array $cart,
        ?Area $area = null,
        ?Coupon $coupon = null,
        string $deliveryMethod = self::METHOD_LOCAL
    ) {
        $this->items = $cart;
        $this->area = $area;
        $this->coupon = $coupon;
        $this->deliveryMethod = in_array($deliveryMethod, [
            self::METHOD_LOCAL,
            self::METHOD_COURIER,
            self::METHOD_PAKISTAN,
        ], true) ? $deliveryMethod : self::METHOD_LOCAL;
    }

    public function subTotal(): float
    {
        return collect($this->items)->sum(
            fn ($item) => $item['price'] * $item['quantity']
        );
    }

    public function productDiscount(): float
    {
        return collect($this->items)->sum(function ($item) {
            $lineTotal = $item['price'] * $item['quantity'];
            $discountPercent = $item['discount'] ?? 0;

            return $lineTotal * ($discountPercent / 100);
        });
    }

    public function couponDiscount(): float
    {
        if (! $this->coupon || ! $this->coupon->isValid()) {
            return 0;
        }

        $amountAfterProductDiscount = $this->subTotal() - $this->productDiscount();

        return $this->coupon->calculateDiscount($amountAfterProductDiscount);
    }

    public function totalDiscount(): float
    {
        return $this->productDiscount() + $this->couponDiscount();
    }

    public function afterDiscount(): float
    {
        return max(0, $this->subTotal() - $this->totalDiscount());
    }

    public function deliveryFee(): float
    {
        if ($this->deliveryMethod === self::METHOD_PAKISTAN) {
            return (float) config('cart.pakistan_delivery_fee', 350);
        }

        if ($this->deliveryMethod === self::METHOD_COURIER) {
            if ($this->area) {
                $areaFee = (float) str_replace(',', '', (string) ($this->area->delivery_charges ?? 0));
                if ($areaFee > 0) {
                    return $areaFee;
                }
            }

            return (float) config('cart.courier_fee', 250);
        }

        // Local area delivery
        if (! $this->area) {
            return 0.0;
        }

        return (float) str_replace(',', '', (string) ($this->area->delivery_charges ?? 0));
    }

    public function platformFee(): float
    {
        return (float) config('cart.platform_fee');
    }

    public function orderTotal(): float
    {
        return $this->afterDiscount() + $this->deliveryFee() + $this->platformFee();
    }

    public function totalQuantity(): int
    {
        return collect($this->items)->sum('quantity');
    }

    public function appliedCouponCode(): ?string
    {
        return $this->coupon && $this->coupon->isValid() ? $this->coupon->code : null;
    }

    public function deliveryMethod(): string
    {
        return $this->deliveryMethod;
    }

    public function summary(): array
    {
        return [
            'sub_total'         => $this->subTotal(),
            'product_discount'  => $this->productDiscount(),
            'coupon_discount'   => $this->couponDiscount(),
            'discount'          => $this->totalDiscount(),
            'after_discount'    => $this->afterDiscount(),
            'delivery_fee'      => $this->deliveryFee(),
            'platform_fee'      => $this->platformFee(),
            'order_total'       => $this->orderTotal(),
            'total_quantity'    => $this->totalQuantity(),
            'coupon_code'       => $this->appliedCouponCode(),
            'delivery_method'   => $this->deliveryMethod(),
        ];
    }

    public static function format(float $amount): string
    {
        return config('cart.currency_symbol') . ' ' . number_format($amount, 2);
    }

    public static function deliveryMethodLabel(?string $method): string
    {
        return match ($method) {
            self::METHOD_COURIER => 'Courier Service',
            self::METHOD_PAKISTAN => 'All Over Pakistan (Courier)',
            default => 'Local Area Delivery',
        };
    }
}
