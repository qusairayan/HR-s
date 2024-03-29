<?php

namespace App\Http\Requests\Leave\Api;

use App\Models\Schedules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateLeaveRequest extends FormRequest
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
            "time"=>"required|date_format:H:i",
            "date"=>"required|date|date_format:Y-m-d",
            "period"=>"required|date_format:H:i",
            "reason"=>"string|max:255|min:3"
        ];
    }
}
