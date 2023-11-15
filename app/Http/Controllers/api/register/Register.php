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
            'password' => 'required|min:8',
        ]);
        if($validator->fails()){
            return response(["success"=>false,"message"=>"validation Error"],400);
        }
        $currentDate = date("Y-m-d");
        $request->merge(['password' =>Hash::make($request->input("password"))]);
        $request->merge(['type' => 'full-time']);
        $request->merge(['name' => 'test']);
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
        $user = User::create($request->all());
        if($user)return response(["success"=>true,"message"=>"User has been registered successfully"],201);
        else return response(["success"=>false,"message"=>"Field registere User"],422);
    }public function destroy(Request $request){
        return response(["success"=>true,"message"=>"User has been deleted successfully"],200);
        // $id = $request->input("id");
        // if(User::destroy($id))return response(["success"=>true,"message"=>"User has been deleted successfully"],200);
        // else return response(["success"=>false,"message"=>"Field deleted User"],422);
    }
}
