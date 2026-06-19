<?php

namespace App\Http\Requests\Frontend\Award;

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
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:50',
            'organization' => 'required|string|max:50',
            'evaluation_period' => 'required|string|max:50',
            'comments' => 'required|string',
            'affidavit' => 'required',
        ];
    }
}
