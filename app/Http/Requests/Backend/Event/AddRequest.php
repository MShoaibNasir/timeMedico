<?php

namespace App\Http\Requests\Backend\Event;

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
            'created_by' => 'required|exists:users,id',
            'name' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'model_type' => 'required|string|max:50',
            'date' => 'required',
            'status' => 'required',
            'recording' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv,mkv',
        ];
    }
}
