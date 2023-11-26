<?php
namespace App\Http\Controllers\Api\Attendence;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attendedence\Api\MakeAttendenceRequest;
use App\Models\Attendence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MakeAttendence extends Controller{
    private $day,$time;
    public function __construct(){
        $day = Carbon::today("Asia/Amman")->isoFormat("YYYY-MM-DD");
        $time = Carbon::now("Asia/Amman")->isoFormat("HH:mm:ss");
    }
    public function attendence(MakeAttendenceRequest $request){
        $request->validated();
        $user = Auth::user();
        $attendece = Attendence::where("user_id",$user->id)->where("date",date("Y-m-d"))->first();
        if($request->type){
            if($attendece)return response()->json(["success"=>false,"message"=>"The user has previously registered attendance"],400);
            $attendece = Attendence::create([
                "type"=>0,
                "user_id"=>$user->id,
                "date"=>$this->day,
                "check_in"=>$this->time
            ]);
        }
        else{
            if($attendece && $attendece->check_out)return response()->json(["success"=>false,"message"=>"The user has previously logged out"],400);
        }
    }
}
