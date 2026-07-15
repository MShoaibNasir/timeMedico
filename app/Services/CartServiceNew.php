<?php

namespace App\Services;

use App\Models\Product;

class CartServiceNew
{
    /**
     * Add Product Into Cart
     */
    public function add(int $productId, int $qty = 1): array
    {
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {

            $cart[$productId]['quantity'] += $qty;

        } else {

            $cart[$productId] = [

                'id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->name,
                'unit' => $product->unit,
                'price' => $product->price,
                'discount' => $product->discount,
                'image' => $product->image,
                'quantity' => $qty,

            ];
        }

        session()->put('cart', $cart);

        return $this->summary();
    }

    /**
     * Update Quantity
     */
    public function update(int $productId, int $qty): array
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {

            $cart[$productId]['quantity'] = $qty;

            session()->put('cart', $cart);
        }

        return $this->summary();
    }

    /**
     * Remove Product
     */
    public function remove(int $productId): array
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {

            unset($cart[$productId]);

            session()->put('cart', $cart);
        }

        return $this->summary();
    }

    /**
     * Clear Cart
     */
    public function clear(): void
    {
        session()->forget('cart');
    }

    /**
     * Get Cart
     */
    public function items(): array
    {
        return session()->get('cart', []);
    }

    /**
     * Cart Count
     */
    public function count(): int
    {
        return collect($this->items())->sum('quantity');
    }

    /**
     * Subtotal
     */
    public function subtotal(): float
    {
        return collect($this->items())->sum(function ($item) {

            $price = $item['price'] - ($item['discount'] ?? 0);

            return $price * $item['quantity'];

        });
    }

    /**
     * Summary
     */
    public function summary(): array
    {
        return [

            'cart' => $this->items(),

            'count' => $this->count(),

            'subtotal' => $this->subtotal(),

        ];
    }
}