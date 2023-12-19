<?php
namespace App\Http\Controllers\Api\Attendence;
use App\Http\Controllers\api\Leave\LeaveController;
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
class createAttendence extends Controller{
    private $day , $time ,$user;
    public function __construct(){
        $this->day = Carbon::today("Asia/Amman")->isoFormat("YYYY-MM-DD");
        $this->time = Carbon::now("Asia/Amman");
    }
    public function create(CreateAttendenceRequest $request){
        $request->validated();
        $this->user = Auth::user();
        $attendance = Attendence::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->first();
        $leave = Leave::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->where('status', '=', 1)->first();
        if($request->type === 0){ //checkin
            if($attendance)return response()->json(["success"=>false,"message"=>"You have registered your attendance for today"],400);
            if(!$leave || !$leave->checkin){//checkin
                $attendance = 
                Attendence::create([
                    "type"=>0,
                    "user_id"=>$this->user->id,
                    "date"=>$this->day,
                    "check_in"=>$this->time
                ]);
                $timeDifference = $this->timeDifference("checkIn");
                if($timeDifference > 5)$this->late($attendance,"checkIn",$timeDifference);
                return response()->json(["success"=>true,"message"=>"attendance checkin successfully"],201);
            }else{
                if(!$leave->checkout){//checkout leave then checkin attendance
                    $leave->checkout = $this->time;
                    $leave->save();
                    $status = new LeaveController();
                    $status->checkoutt($leave);
                    $attendance = Attendence::create([
                        "type"=>0,
                        "user_id"=>$this->user->id,
                        "date"=>$this->day,
                        "check_in"=>$this->time
                    ]);
                    $timeDifference = $this->timeDifference("checkIn");
                    Lateness::create([
                        "user_id"=>$this->user->id,
                        "attendence_id"=>$attendance->id,
                        "amount"=>$timeDifference,
                        "on"=>"checkIn",
                        "detailes"=>"leave on time ".$this->time->format("Y-m-d H:i:s")
                    ]);
                    return response()->json(["success"=>true,"message"=>"attendance checkin successfully"],201);
                }
            }
        }else{//checkout
            if(!$attendance || $attendance?->check_out)return response()->json(["success"=>false,"message"=>"You have registered your attendance for today"],400);
            if($leave && !$leave->checkin )return response()->json(["success"=>false,"message"=>"You cannot check out before leave"],400);
            if($leave && !$leave->checkout){
                $status = new LeaveController();
                $status->checkoutt($leave);
            }
            $attendance->check_out = $this->time;
            $attendance->save();
            $timeDifference = $this->timeDifference("checkOut");
            if($timeDifference > 6)$this->late($attendance,"checkOut",$timeDifference);
            elseif($timeDifference <= 30)$this->overTime($attendance);
            return response()->json(["success"=>true,"message"=>"attendance checkout successfully"],201);
        }
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
    public function AttendenceToday(){
        $user = Auth::user();
        $data = Attendence::where("user_id",$user->id)->where("date",date("Y-m-d"))->select("date","check_in","check_out")->first();
        if(!$data)return response()->json(["success"=>true,"data"=>0],200);
        if($data->check_in && $data->check_out)return response()->json(["success"=>true,"data"=>2],200);
        if($data->check_in)return response()->json(["success"=>true,"data"=>1],200);
    }
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
        // $user = User::where("id",$id)->select("annual_vacation","sick_vacation")->first();
        // $schedule =Schedules::where("user_id","=",$id)->where("date",">=",date("Y-m-d"))->orderBy("date")->get();
        // return response(["schedule"=>$schedule,"vacations"=>$user],200);
    }
    public function __destruct(){
        $this->day = NULL;
        $this->time = NULL;
        $this->user = NULL;
    }
}