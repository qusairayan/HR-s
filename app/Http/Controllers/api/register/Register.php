<?php

namespace App\Http\Controllers\api\register;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Register extends Controller
{
    public function create(Request $request){
      
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|min:3|unique:users,username',
            'email'    => 'required|email|max:100|min:7|unique:users,email',
            'password' => ['required','confirmed',Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
        ]);
        if($validator->fails()){
            return response($validator->errors(),400);
        }
        $currentDate = date("Y-m-d");
        $request->merge(['password' =>Hash::make($request->input("password"))]);
        $request->merge(['type' => 'full-time']);
        $request->merge(['salary' => 0]);
        $request->merge(['bank' => '1']);
        $request->merge(['IBAN' => 'IBAN']);
        $request->merge(['ID_no' => '1234567890']);
        $request->merge(['birthday' => $currentDate]);
        $request->merge(['phone' => "1234567890"]);
        $request->merge(['department_id' => "1"]);
        $request->merge(['company_id' => "1"]);
        $request->merge(['position' => "IT"]);
        $request->merge(['start_date' => $currentDate]);
        $request = $request->except('password_confirmation');
        $user = User::create($request);
        if($user)return response("User has been registered successfully",200);
    }
}
