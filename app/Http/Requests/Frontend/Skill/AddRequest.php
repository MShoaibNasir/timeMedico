<?php

namespace App\Http\Requests\Frontend\Skill;

use App\Enums\SkillProficiency;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

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
            'user_id' => 'required|exists:admins,id',
            'name' => 'required|string|max:50',
            'skill_proficiency' => ['nullable', new Enum(SkillProficiency::class)],
            'description' => 'nullable|string',
        ];
    }
}
