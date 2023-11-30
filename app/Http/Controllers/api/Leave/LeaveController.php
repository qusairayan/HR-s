<?php
namespace App\Http\Controllers\api\Leave;
use App\Http\Controllers\Controller;
use App\Http\Requests\Leave\Api\makeLeaveRequest;
use App\Models\Leave;
use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LeaveController extends Controller{
    private $user , $schedule;
    public function leave(makeLeaveRequest $request){
        $this->user  = Auth::user();
        $this->schedule = Schedules::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->select("schedule.off-day as off","schedule.*")->first();
        //Make sure there is a Schedules
        if(!$this->schedule)return response()->json(["success"=>false,"message"=>"Please set a work schedule for today first"],400);
        //Verify holidays
        if($this->schedule->off)return response()->json(["success"=>false,"message"=>"You cannot take a leave on this day"],400);
        //allow to user one leave per day
        $leave = Leave::where("date",date("Y-m-d"))->where("user_id",$this->user->id)->first();
        if($leave)return response()->json(["success"=>false,"message"=>"You have already leave"],400);
        //Ensure that the departure time is within official working hours
        $time =  $request->only("time")["time"];
        $time = Carbon::createFromFormat("H:i:s",$time,"Asia/Amman");
        if($time->format("H:i:s") < $this->schedule->from || $time->format("H:i:s") > $this->schedule->to)return response()->json(["success"=>false,"message"=>"The time must be within working hours"],401);
        //Ensure that the departure time does not exceed 6 hours
        $period =  $request->only("period");
        list ($hour,$minute)=explode(":",$period["period"]);
        $fullTime = ($hour * 60) + $minute;
        if($fullTime > 360)return response()->json(["success"=>false,"message"=>"You cannot take more than 6 hours of leave"],401);
        // Ensure that the departure time does not exceed the end of work time
        // $time =  $request->only("time")["time"];
        // $time = explode(":",$time->format("H:i:s"));
        // $time = Carbon::createFromTime($time[0],$time[1],0,"Asia/Amman");
        $time = $time->addMinutes($fullTime);
        if($this->schedule->to < $time->format("H:i:s"))return response()->json(["success"=>false,"message"=>"Departure time exceeds work end time"],401);
        Leave::create($request->all());
        return response()->json(["success"=>true,"message"=>"Departure request completed successfully"],201);
    }
    public function __destruct(){
        $this->user = NULL;
        $this->schedule = NULL;
    }
}