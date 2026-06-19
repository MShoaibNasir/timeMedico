<?php

namespace App\Http\Requests\Frontend\Award;

use App\Http\Requests\BackendBaseRequest;

class UpdateRequest extends BackendBaseRequest
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
            'id' => 'required',
            'recording' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv,mkv',
        ];
    }
}
