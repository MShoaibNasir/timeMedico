<?php

namespace App\Http\Requests\Frontend\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    // Allow everyone to make this request
    public function authorize()
    {
        return true;
    }

    // Validation rules
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',      // lowercase
                'regex:/[A-Z]/',      // uppercase
                'regex:/[0-9]/',      // number
                'regex:/[@$!%*?&]/',  // special character
            ],
        ];
    }

    // Custom messages
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password and Confirm Password do not match',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character',
        ];
    }
}
