<?php

namespace App\Http\Requests\Auth\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
class VerfyOtpRequest extends FormRequest
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
            "email"=>"required|min:3|max:30|email:rfc,dns|exists:users,email",
            "otp"=>"required|digits:6"
        ];
    }
}
