<?php

namespace App\Services;

use App\Models\Area;
use App\Models\Coupon;



class CartService
{
    protected array $items;
    protected ?Area $area;
    protected ?Coupon $coupon;

    public function __construct(array $cart, ?Area $area = null, ?Coupon $coupon = null)
    {
        // $cart wahi array hai jo session mein store ho raha hai:
        // [$product->id => ['id','sku','name','unit','price','discount','image','quantity'], ...]
        $this->items  = $cart;
        $this->area = $area;
        $this->coupon = $coupon;
    }

    /**
     * Sub Total = sab items ka (price * quantity) ka sum, discount se pehle.
     */
    public function subTotal(): float
    {
        return collect($this->items)->sum(
            fn ($item) => $item['price'] * $item['quantity']
        );
    }

    /**
     * Product-level Discount = sab items ka percentage-based discount amount sum.
     * NOTE: 'discount' field product ke against PERCENTAGE hota hai (jaise 10 = 10%),
     * flat amount NAHI hai - is liye price * quantity * (discount/100) calculate karte hain.
     */
    public function productDiscount(): float
    {
        return collect($this->items)->sum(function ($item) {
            $lineTotal = $item['price'] * $item['quantity'];
            $discountPercent = $item['discount'] ?? 0;

            return $lineTotal * ($discountPercent / 100);
        });
    }

    /**
     * Coupon Discount - agar koi valid coupon apply hai to us se calculate hoga,
     * subtotal minus product-discount ke against.
     */
    public function couponDiscount(): float
    {
        if (! $this->coupon || ! $this->coupon->isValid()) {
            return 0;
        }

        $amountAfterProductDiscount = $this->subTotal() - $this->productDiscount();

        return $this->coupon->calculateDiscount($amountAfterProductDiscount);
    }

    /**
     * Total Discount = Product Discount + Coupon Discount (combined, display ke liye)
     */
    public function totalDiscount(): float
    {
        return $this->productDiscount() + $this->couponDiscount();
    }

    /**
     * After Discount = Sub Total - (Product Discount + Coupon Discount)
     */
    public function afterDiscount(): float
    {
        return max(0, $this->subTotal() - $this->totalDiscount());
    }

    public function deliveryFee(): float
    {
        //return (float) config('cart.delivery_fee');
        //return (float) ($this->area->delivery_charges ?? 0);
        return (float) str_replace(',', '', $this->area->delivery_charges ?? 0);
    }

    public function platformFee(): float
    {
        return (float) config('cart.platform_fee');
        
    }

    /**
     * Order Total = After Discount + Delivery Fee + Platform Fee
     */
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

    /**
     * Sab totals ek array mein - Blade view ko ek hi call se pura data dena ho to.
     */
    public function summary(): array
    {
        return [
            'sub_total'        => $this->subTotal(),
            'product_discount' => $this->productDiscount(),
            'coupon_discount'  => $this->couponDiscount(),
            'discount'         => $this->totalDiscount(),
            'after_discount'   => $this->afterDiscount(),
            'delivery_fee'     => $this->deliveryFee(),
            'platform_fee'     => $this->platformFee(),
            'order_total'      => $this->orderTotal(),
            'total_quantity'   => $this->totalQuantity(),
            'coupon_code'      => $this->appliedCouponCode(),
        ];
    }

    public static function format(float $amount): string
    {
        return config('cart.currency_symbol') . ' ' . number_format($amount, 2);
    }
}