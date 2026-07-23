<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AreaBulkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules()
{
    return [
        'price' => ['required', 'numeric', 'min:0'],
        'calcualtion_option' => ['required', 'in:add,minus'],
        'area_ids' => ['nullable', 'array'],
        'area_ids.*' => ['integer', 'exists:area,id'],
    ];
}

    public function messages(): array
    {
        return [
          
        ];
    }
}
