<?php
namespace App\Http\Controllers\Api\Attendence;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attendedence\Api\CreateAttendenceRequest;
use App\Models\Attendence;
use App\Models\Lateness;
use App\Models\Leave;
use App\Models\Overtime;
use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MakeAttendence extends Controller{
    private $day , $time ,$user;
    public function __construct(){
        $this->day = Carbon::today("Asia/Amman")->isoFormat("YYYY-MM-DD");
        $this->time = Carbon::now("Asia/Amman");
    }
    public function create(CreateAttendenceRequest $request){
        $request->validated();
        $this->user = Auth::user();
        $attendece = Attendence::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->first();
        if($request->type == 0){
            // case 1 : the user logged in before
            if($attendece)return response()->json(["success"=>false,"message"=>"The user has already registered for attendance"],400);
            // case 2 : The user has to leave at the beginning of the shift
            $leave = Leave::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->where('status', '=', 1)->first();
            if($leave){
                $schedule =  Schedules::where("date",$this->day)->where("user_id",$this->user->id)->first();
                if($leave->time == $schedule->from){
                    if(!$leave->checkout)$leave->checkout = $this->time;
                    Attendence::create([
                        "type"=>0,
                        "user_id"=>$this->user->id,
                        "date"=>$this->day,
                        "check_in"=>$this->time
                    ]);
                    $timeDifference = $this->timeDifference("checkIn"); 
                    if($timeDifference > 5){
                        Lateness::create([
                            "user_id"=>$this->user->id,
                            "attendence_id"=>$attendece->id,
                            "amount"=>$timeDifference,
                            "on"=>"checkIn",
                            "detailes"=>"leave on time ".$this->time->format("Y-m-d H:i:s")
                        ]);
                    }
                }
            }
            else{
                $attendece = Attendence::create([
                    "type"=>0,
                    "user_id"=>$this->user->id,
                    "date"=>$this->day,
                    "check_in"=>$this->time
                ]);
                $timeDifference = $this->timeDifference("checkIn");
                if($timeDifference > 5)$this->late($attendece,$on = "checkIn" , $timeDifference);
            }
        }else{
            if($attendece){
                if($attendece->check_out)return response()->json(["success"=>false,"message"=>"The user has previously cehcked out"],400);
                $leave = Leave::leftJoin("schedule", "leaves.user_id", "=", "schedule.user_id")
                ->where('leaves.user_id', '=', $this->user->id)
                ->where('leaves.date', '=', $this->day)
                ->where('leaves.status', '=', 1)
                ->first();
                $attendece->check_out = $this->time;
                $attendece->save();
                $timeDifference = $this->timeDifference("checkOut");
                if(!$leave){
                    if($timeDifference <= 30)$this->overTime($attendece);
                    else if($timeDifference > 6)$this->late($attendece,$on = "checkOut" ,$timeDifference);
                }else{
                    // before
                    $timeStartLeave = Carbon::createFromTimeString($leave->time, "Asia/Amman");
                    $timeEndLeave = Carbon::createFromTimeString($leave->time, "Asia/Amman");
                    list($hours, $minutes) = explode(":", $leave->period);
                    $timeEndLeave->addHours($hours)->addMinutes($minutes);
                    // before
                    if($this->time->format("Y-m-d H:i:s") < $timeStartLeave->format("Y-m-d H:i:s")){
                            return response()->json(["success"=>false,"message"=>"You have leave you cannot check out"],400);
                        }
                    else{
                        if($this->time->format("Y-m-d H:i:s") > $timeEndLeave->format("Y-m-d H:i:s")){
                            if($timeDifference <= 30)$this->overTime($attendece);
                            else if($timeDifference > 6)$this->late($attendece,$on = "checkOut" ,$timeDifference);
                        }else{
                            if(!$leave->checkout)return response()->json(["success"=>false,"message"=>"You must end leave first"],400);
                            $timeDifference  = $this->timeDifference("checkout", $timeEndLeave);
                            $this->late($attendece,$on = "checkOut" , $timeDifference);
                        }
                    }
                }
            }else{
                return response()->json(["success"=>false,"message"=>"There is no check in record for this day please check in first"],400);        
            }
        }
        return response()->json(["success"=>true,"message"=>"attendance taken successfully"],201);
    }
    private function timeDifference($on , $time = NULL) :string {
        if(!$time)$time = $this->time;
        $scheduale = Schedules::where("date",$this->day)->where("user_id",$this->user->id)->first();
        if($scheduale){
            if($on == "checkIn")return $time->diffInMinutes($scheduale->from);
            else return $time->diffInMinutes($scheduale->to);
        }
    }
    private function late($attendece , $on , $timeDifference){
        Lateness::create([
            "user_id"=>$this->user->id,
            "attendence_id"=>$attendece->id,
            "amount"=>$timeDifference,
            "on"=>$on
        ]);
    }
    public function overTime($attendece){
        Overtime::create([
            "amount"=>$this->time,
            "attendence_id"=>$attendece->id,
            "user_id"=>$this->user->id,
        ]);
    }
    public function __destruct(){
        $this->day = NULL;
        $this->time = NULL;
        $this->user = NULL;
    }
}