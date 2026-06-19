<?php

namespace App\Http\Requests\Backend\DTP;

use App\Http\Requests\BackendBaseRequest;

class AddRequest extends BackendBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'resource_type' => 'required',
            'price' => 'required',
            'date' => 'required'

        ];
    }
}
