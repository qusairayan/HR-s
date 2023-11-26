<?php

namespace App\Http\Requests\Auth\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255|min:3|unique:users,username',
            'email'    => 'required|email|max:100|min:7|unique:users,email',
            'password' => 'required|min:8',
        ];
    }
}
