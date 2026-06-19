<?php

namespace App\Http\Requests\Frontend\AdditionalCertificate;

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
            'certificate_title' => 'required',
            'skills' => 'required',
            'issuing_organization' => 'required',
            'issue_date' => 'required',
            'affidavit' => 'required',
        ];
    }
}
