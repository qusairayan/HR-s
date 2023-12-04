<?php
namespace App\Http\Controllers\api\Leave;
use App\Http\Controllers\Controller;
use App\Http\Requests\Leave\Api\EditLeaveRequest;
use App\Http\Requests\Leave\Api\CreateLeaveRequest;
use App\Models\Attendence;
use App\Models\Lateness;
use App\Models\Leave;
use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class LeaveController extends Controller{
    private $user , $schedule;
    public function control(){
        $this->user  = Auth::user();
        $leave = Leave::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->first();
        if(!$leave || $leave?->status ==0)return response()->json(["success"=>true,"data"=>0],200);
        else{
            if($leave->cehckin && $leave->checkout )return response()->json(["success"=>true,"data"=>0],200);
            if(!$leave->checkin)return response()->json(["success"=>true,"data"=>1,"leave"=>$leave],200);
            if(!$leave->checkout)return response()->json(["success"=>true,"data"=>2],200);
        }
    }
    public function create(CreateLeaveRequest $request){
        $request->validated();
        //allow to user one leave per day
        if($this->user->annual_vacation < 1)return response()->json(["success"=>false,"message"=>"You do not have any vacation leave"],400);
        $leave = Leave::where("date",$request->only("date"))->where("user_id",$this->user->id)->first();
        if($leave)return response()->json(["success"=>false,"message"=>"You have already leave"],400);
        $this->schedule = Schedules::where("user_id",$this->user->id)->where("date",$request->only("date"))->select("schedule.off-day as off","schedule.*")->first();
        //Make sure there is a Schedules
        if(!$this->schedule)return response()->json(["success"=>false,"message"=>"Please set a work schedule for today first"],400);
        //Verify holidays
        if($this->schedule->off)return response()->json(["success"=>false,"message"=>"You cannot take a leave on this day"],400);
        //Ensure that the departure time is within official working hours
        $time =  $request->only("time")["time"];
        $time = Carbon::createFromFormat("H:i",$time,"Asia/Amman");
        if($time->format("H:i:s") < $this->schedule->from || $time->format("H:i:s") > $this->schedule->to)return response()->json(["success"=>false,"message"=>"The time must be within working hours"],401);
        //Ensure that the departure time does not exceed 6 hours
        $period =  $request->only("period");
        list ($hour,$minute)=explode(":",$period["period"]);
        $fullTime = ($hour * 60) + $minute;
        if($fullTime > 360)return response()->json(["success"=>false,"message"=>"You cannot take more than 6 hours of leave"],401);
        // Ensure that the departure time does not exceed the end of work time
        $time = $time->addMinutes($fullTime);
        if($this->schedule->to < $time->format("H:i:s"))return response()->json(["success"=>false,"message"=>"Departure time exceeds work end time"],401);
        $request["user_id"] = $this->user->id;
        Leave::create($request->all());
        return response()->json(["success"=>true,"message"=>"Leave request completed successfully"],201);
    }
    public function edit(EditLeaveRequest $request, $id){
        $request->validated();
        $leave =Leave::find($id);
        if(!$leave)return response()->json(["success"=>false,"message"=>"there are no leave"],404);
        if($leave->status != 0)return response()->json(["success"=>false,"message"=>"leave has been accepted and you cannot modify it"],401);
        $leave->update($request->all());
        return response()->json(["success"=>true,"message"=>"leave has been successfully modified"]);
    }
    public function delete($id){
        $leave = Leave::find($id);
        if(!$leave)return response()->json(["success"=>false,"message"=>"there are no leave"],404);
        if($leave->status != 0)return response()->json(["success"=>false,"message"=>"leave has been accepted and you cannot modify it"],401);
        $$leave->delete();
        return response()->json(["success"=>true,"message"=>"Leave has been successfully deleted"],200);
    }
    public function get(){
        $this->user  = Auth::user();
        $leaves = Leave::where("user_id",$this->user->id)->where("date","LIKE",date("Y-m")."-%")->get();
        return response()->json(["success"=>true,"data"=>$leaves],200);
    }
    public function getAll(){
        // just admin
        $leaves = Leave::all()->latest();
        return response()->json(["success"=>true,"data"=>$leaves],200);
    }
    public function checkin() {
        $this->user  = Auth::user();
        // check if user in leave today
        $leave = Leave::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->whereNull("checkin")->whereNull("checkout")->first();
        if($leave){
            $this->checkIfLeaveLast($leave);
            $leave->checkin = Carbon::now()->format("H:i:s");
            $leave->save();
            return response()->json(["success"=>true,"message"=>"You have successfully checked in"],201);
        }else{
            return response()->json(["success"=>false,"message"=>"You have fieald checked in"],404);
        }
    }
    public function checkout(){
        $this->user  = Auth::user();
        // check if user in leave today
        $leave = Leave::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->whereNotNull("checkin")->whereNull("checkout")->first();
        if($leave){
            $time = Carbon::now()->format("H:i:s");
            $leave->checkout = $time;
            $leave->total_leave = gmdate("H:i:s",(strtotime($leave->checkout) - strtotime("00:00:00"))   - (strtotime($leave->checkin) - strtotime("00:00:00")));
            $leave =  $leave->save();
            $this->vacationDiscount();
            return response()->json(["success"=>true,"message"=>"You have successfully checked out"],201);
        }else  return response()->json(["success"=>false,"message"=>"You have fieald checked out"],404);
    }
    private function vacationDiscount(){
        $time = Leave::where("user_id",$this->user->id)->where("discount",0)
        ->select(DB::raw('SUM(TIME_TO_SEC(total_leave)) as total_seconds'))
        ->first();
        if($time->total_seconds > 21600){
            $time->total_seconds= 21600;
            $leaves = Leave::where("user_id",$this->user->id)->where("discount",0)->get();
            foreach ($leaves as $value) {
                if((strtotime($value->total_leave) - strtotime("00:00:00") )> $time->total_seconds){
                    $value->total_leave = strtotime($value->total_leave) - strtotime("00:00:00");
                    $value->total_leave -= $time->total_seconds;
                    $value->total_leave = gmdate("H:i:s", $value->total_leave);
                    $value->save();
                }else{
                    $time->total_seconds -= strtotime($value->total_leave) - strtotime("00:00:00");
                    $value->total_leave = 0;
                    $value->discount = 1;
                    $value->save();
                }
            }
            if($this->user->annual_vacation > 0){
                $this->user->annual_vacation--;
                $this->user->save();
            }
        }
    }
    private function checkIfLeaveLast($leave){
        $schedule = Schedules::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->first();
        $time = gmdate("H:i:s",(strtotime($leave->time) - strtotime("00:00:00")) +(strtotime($leave->period) - strtotime("00:00:00"))) ;
        if($time === $schedule->to){
            $attendece = Attendence::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->whereNotNull("check_in")->whereNull("check_out")->first();
            if($attendece){
                $time = Carbon::now();
                $attendece->check_out = $time->format("H:i:s");
                $attendece->save();
                $time2 = $time->diffInMinutes($schedule->to);
                if($time2 > 5){
                    Lateness::create([
                        "user_id"=>$this->user->id,
                        "attendence_id"=>$attendece->id,
                        "amount"=>$time2,
                        "on"=>"cehckOut",
                        "detailes"=>"leave on time ".$time->format("Y-m-d H:i:s")
                    ]);
                }
            }
        }
    }
    public function __destruct(){
        $this->user = NULL;
        $this->schedule = NULL;
    }
}