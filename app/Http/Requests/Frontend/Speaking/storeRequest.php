<?php

namespace App\Http\Requests\Frontend\Speaking;

use App\Enums\SkillProficiency;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class storeRequest extends BaseRequest
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
            'topic' => 'required|string|max:50',
            'topic_brief' => 'required|max:100|string',
            'suggested_platform' => 'required',
            'video_link' => 'required',
            'duration' => 'required',
    ];
    }
}
