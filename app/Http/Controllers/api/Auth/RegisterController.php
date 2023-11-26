<?php
namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller{
    public function create(RegisterRequest $request){
        $request->validated();
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
        $request->merge(['Duration_contract' =>0]);
        $request->merge(['social_security' =>0]);
        $request->merge(['status' =>0]);
        $user = User::create($request->all());
        if($user)return response(["success"=>true,"message"=>"User has been registered successfully"],201);
        else return response(["success"=>false,"message"=>"Field registere User"],422);
    }
}
