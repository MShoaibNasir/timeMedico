<?php

namespace App\Http\Requests\Frontend\professionalExperience;

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
            'job_title' => 'required|string|max:50',
            'organization_name' => 'required|string|max:50',
            'job_description' => 'required|string|max:50',
            'start_date' => 'required|string|max:50',
            'end_date' => 'required',
            'Country' => 'required',
            'affidavit' => 'required',
        ];
    }
}
