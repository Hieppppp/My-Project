<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('user'),
            'password' => 'nullable|confirmed|string|min:8',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'phone' => ['required', 'regex:/^(03|05|07|08|09|01[2|6|8|9])\d{8}$/'],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'The phone number format is invalid. Please enter a valid Vietnamese phone number.',
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.date' => 'The date of birth is not a valid date.',
            'date_of_birth.before_or_equal' => 'The date of birth must be a date before or equal to today.',
            'avatar.image' => 'The avatar must be an image file.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif, svg.',
            'avatar.max' => 'The avatar may not be greater than 2048 KB.',
        ];
    }
}
