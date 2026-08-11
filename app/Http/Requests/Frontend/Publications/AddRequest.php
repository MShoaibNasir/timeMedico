<?php

namespace App\Http\Requests\Frontend\Publications;

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
            'user_id' => 'required',
            'title' => 'required',
            'topics' => 'required',
            'publication_type' => 'required',
            'published_date' => 'required',
            'publisher_name' => 'required',
            'url' => 'required',
            'description' => 'required',
        ];
    }
}
