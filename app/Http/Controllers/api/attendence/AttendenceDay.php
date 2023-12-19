<?php

namespace App\Http\Controllers\api\attendence;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendenceDay extends Controller
{
    public function Attendenceday(){
        $user = Auth::user();
        $data = Attendence::where("user_id",$user->id)->where("date",date("Y-m-d"))->select("date","check_in","check_out")->first();
        if(!$data)return response()->json(["success"=>true,"data"=>0],200);
        if($data->check_in && $data->check_out)return response()->json(["success"=>true,"data"=>2],200);
        if($data->check_in)return response()->json(["success"=>true,"data"=>1],200);
    }
}
