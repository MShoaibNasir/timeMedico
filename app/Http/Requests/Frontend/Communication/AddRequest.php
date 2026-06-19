<?php

namespace App\Http\Requests\Frontend\Communication;

use App\Http\Requests\BaseRequest;

class AddRequest extends BaseRequest
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
            'created_by' => 'required|exists:users,id',
            'title' => 'required|string|max:50',
            'type' => 'nullable|string',
            'duration' => 'nullable|string',
            'video' => 'nullable|string',
            'link' => 'nullable|string',
            'agenda' => 'nullable|string',
            'resource_type' => 'nullable|string',
        ];
    }
}
