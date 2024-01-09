<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CreateVacationRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'date'=>"date|date_format:Y-m-d|after:today",
            "type"=>"boolean",
            "period"=>"integer|digits_between:1,2",
            "image"=>"image",
        ];
    }
    public function messages(): array
    {
        return  ["image"=>"the attached file should be an image"];
    }
}
