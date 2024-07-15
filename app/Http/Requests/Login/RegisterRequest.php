<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    /**
     * rules
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
    
    /**
     * messages
     *
     * @return array
     */
    public function messages():array
    {
        return [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required',
            'email.email' => 'The email must be a valid email address',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}

