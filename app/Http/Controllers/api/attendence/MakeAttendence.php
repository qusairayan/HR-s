<?php
namespace App\Http\Controllers\Api\Attendence;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attendedence\Api\MakeAttendenceRequest;
use App\Models\Attendence;
use App\Models\Lateness;
use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MakeAttendence extends Controller{
    private $day , $time ,$user;
    public function __construct(){
        $this->day = Carbon::today("Asia/Amman")->isoFormat("YYYY-MM-DD");
        $this->time = Carbon::now("Asia/Amman")->isoFormat("HH:mm:ss");
        $this->user = Auth::user();
    }
    public function attendence(MakeAttendenceRequest $request){
        $request->validated();
        $attendece = Attendence::where("user_id",$this->user->id)->where("date",date("Y-m-d"))->first();
        if($request->type){
            if($attendece)return response()->json(["success"=>false,"message"=>"The user has previously registered attendance"],400);
            $attendece = Attendence::create([
                "type"=>0,
                "user_id"=>$this->user->id,
                "date"=>$this->day,
                "check_in"=>$this->time
            ]);
            $this->late($attendece,$on = "check_in");
        }else{
            if($attendece && $attendece->check_out)return response()->json(["success"=>false,"message"=>"The user has previously logged out"],400);
            $attendece->check_out = $this->time;
            $attendece->save();
        }
    }
    public function late($attendece , $on){
        $scheduale = Schedules::where("date",$this->day)->where("user_id",$this->user->id)->first();
        if($scheduale){
            $time = Carbon::now("Asia/Amman");
            $time = $time->diffInMinutes($scheduale->from);
            if($time > 5){
                $lateness = Lateness::create([
                    "user_id"=>$this->user->id,
                    "attendence_id"=>$attendece->id,
                    "amount"=>$time,
                    "on"=>$on
                ]);
            }
        }
    }
    public function __destruct(){
        $this->day = NULL;
        $this->time = NULL;
    }
}