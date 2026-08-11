<?php

namespace App\Http\Requests\Frontend\BioProfile;

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
            'bio_summery' => 'required',
            'linkedin_url' => 'required',
            'website_url' => 'required',
            'facebook_url' => 'required',
            'twitter_url' => 'required',
            'instagram_url' => 'required',
        ];
    }
}
