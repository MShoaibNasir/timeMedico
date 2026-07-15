<?php

namespace App\Http\Requests\Frontend\Cart;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'nullable|integer|min:1',
            //'variant_product' => 'nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Product not found.',
            'product_id.exists'   => 'Invalid product.',
            'quantity.min'        => 'Quantity must be at least 1.'
        ];
    }
}
