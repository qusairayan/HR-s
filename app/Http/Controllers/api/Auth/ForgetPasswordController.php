<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\ForgetPasswordRequest;
use App\Models\User;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(ForgetPasswordRequest $request){
        return response()->json("xsaxasxsa",200);
        $request->validated();
        $user = User::where("email",$request->only("email"))->first();
        $user->notify(new ForgetPasswordNotification());
        return response()->json(["success"=>true,'message'=>"A code has been sent to the requested email"],200);
    }
}