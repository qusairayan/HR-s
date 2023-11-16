<?php

namespace App\Http\Controllers\api\attendence;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
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
}
