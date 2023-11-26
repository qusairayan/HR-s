<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\VerfyOtpRequest;
use Ichtrojan\Otp\Models\Otp as ModelsOtp;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
class VerfyOtpController extends Controller{   
    private $otp;
    public function __construct(){
        $this->otp= new Otp();
    }
    public function verifyOtp(VerfyOtpRequest $request){
        $request->validated();
        $otp = $request->otp;
        $otp = $this->otp->validate($request->email,$request->otp);
        ModelsOtp::where("identifier",$request->email)->where("token",$request->otp)->delete();
        if($otp->status)return response()->json(["success"=>true,'message'=>"otp activated successfuly"],200);
        else return response()->json(["success"=>false,'message'=>"otp activation failed please try again"],200);
    }
}
