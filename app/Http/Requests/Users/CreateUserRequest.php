<?php
namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'phone' => ['required', 'regex:/^(03|05|07|08|09|01[2|6|8|9])\d{8}$/'],
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ];
    }

    
}
