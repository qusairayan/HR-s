<?php

namespace App\Http\Requests\Attendedence\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttendenceRequest extends FormRequest
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
            "type"=>"required|boolean",
            "location"=>"required|string"
        ];
    }
}
