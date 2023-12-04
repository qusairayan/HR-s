<?php

namespace App\Http\Requests\Leave\Api;

use Illuminate\Foundation\Http\FormRequest;

class EditLeaveRequest extends FormRequest
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
            "time"=>"date_format:H:i",
            "date"=>"date|date_format:Y-m-d",
            "period"=>"date_format:H:i",
            "reason"=>"string|max:255|min3"
        ];
    }
}
