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
            'password' => 'nullable|string|min:8',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'phone' => 'required|regex:/^(09\d{8})$/',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ];
    }
}
