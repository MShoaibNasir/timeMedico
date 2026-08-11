<?php

namespace App\Http\Requests\Frontend\Education;

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
            'degree' => 'required',
            'degree_title' => 'required',
            'majors' => 'required',
            'institute_name' => 'required',
            'board_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'obtained_marks' => 'required',
            'total_marks' => 'required',
            'obtained_percentage' => 'required',
            'grade' => 'required',
            'foreign_qualified' => 'required',
            'education_document' => 'required',
        ];
    }
}
