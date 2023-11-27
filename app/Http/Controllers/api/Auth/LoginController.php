<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function login(LoginRequest $request){
        $request->validated();
        if(Auth::attempt(["username"=>$request->username,"password"=>$request->password])){
            $user = Auth::user();
            if($user->status === 0){
                return response()->json(["message"=>"Your account is inactive"],401);
            }else{
                $user->tokens()->delete();
                $user = $user->makeHidden("password","email_verified_at","created_at","updated_at");
                $user->token = $user->createToken($request->userAgent())->plainTextToken;
                return response()->json(["message"=>"success","user"=>$user],200);
            }
        }else{
            return response()->json(["message"=>"The username or password is incorrect please try again"],401);
        }
    }
    public function logout(Request $request){
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(["message"=>"logout successfuly"],200);
    }
}