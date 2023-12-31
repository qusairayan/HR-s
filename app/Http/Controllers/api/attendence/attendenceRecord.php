<?php

namespace App\Http\Controllers\api\attendence;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Schedules;
use App\Models\User;
use Illuminate\Http\Request;

class attendenceRecord extends Controller
{
    public function recordApi(Request $request){
        $id = $request->input("id");
        $attendanceList = Attendence::leftJoin("leaves","attendence.date","=","leaves.date")
        ->select(
            "attendence.date as attendence_date",
            "attendence.check_in as check_in",
            "attendence.check_out as check_out",
            "leaves.date as leaves_date",
            )->where('attendence.user_id',$id)
            ->where("attendence.date","LIKE",date("Y-m")."-%")
            ->orderBy("attendence.date")
            ->get();
            return response($attendanceList,200);
    }
    public function getSchedule(Request $request){
        
        $id = $request->input("id");
        $user = User::where("id",$id)->select("annual_vacation","sick_vacation")->first();
        $schedule =Schedules::where("user_id","=",$id)->where("date",">=",date("Y-m-d"))->orderBy("date")->get();
        return response(["schedule"=>$schedule,"vacations"=>$user],200);
    }
}
