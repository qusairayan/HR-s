<?php
namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\ResetPassword as ApiResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ResetPassword extends Controller{
    public function ResetPassword(ApiResetPassword $request){
        $request->validated();
        $user = User::where("email",$request->email)->first();
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(["success"=>true,"message"=>"The password has been modified successfully"],204);
        }else{
            return response()->json(["success"=>false,"message"=>"the user not found"],404);
        }
    }
}
