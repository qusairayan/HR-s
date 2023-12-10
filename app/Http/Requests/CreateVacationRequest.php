<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CreateVacationRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'date'=>"required|date|date_format:Y-m-d|after:today",
            "type"=>"required|boolean",
            "period"=>"required|integer|digits_between:1,2",
        ];
    }
}
