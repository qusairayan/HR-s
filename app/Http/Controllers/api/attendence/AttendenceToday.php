<?php
namespace App\Http\Controllers\Api\Attendence;
use App\Http\Controllers\Controller;
use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendenceToday extends Controller{
    public function AttendenceToday(){
        $user = Auth::user();
        $data = Attendence::where("user_id",$user->id)->where("date",date("Y-m-d"))->select("date","check_in","check_out")->first();
        return response()->json(["success"=>true,"data"=>$data]);
    }
}
