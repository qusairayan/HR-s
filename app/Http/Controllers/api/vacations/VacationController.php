<?php
namespace App\Http\Controllers\api\vacations;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVacationRequest;
use App\Http\Requests\EditVacationRequest;
use App\Models\Schedules;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VacationController extends Controller
{
    public function create(CreateVacationRequest $request)
    {
        $request->validated();
        $user = Auth::user();
        if($request->type){
            if($user->annual_vacation < $request->period)return response()->json(["success"=>false,"message"=>"You do not have enough vacation leave"],400);
        }else{
            if($user->sick_vacation < $request->period)return response()->json(["success"=>false,"message"=>"You do not have enough vacation leave"],400);
        }
        $period = Carbon::createFromFormat("Y-m-d",$request->date,"Asia/Amman");
        $period->addDays($request->period);
        $vecation = Vacation::where("user_id",$user->id)->whereBetween("date",[$request->date,$period->format("Y-m-d")])->first();
        if($vecation)return response()->json(["success">false,"message"=>"You have that day off"],400);
        if($request->hasFile("image")){
            $file = $request->file("image");
            $path = $file->store('public/vacation');
            $asset = "https://". $request->getHttpHost()."/".$path;
            $request->merge(['asset' => $asset]);
        }
        $request->merge(['user_id' => $user->id]);
        Vacation::create($request->all());
        return response()->json(["success",true,"message","Your leave request has been completed successfully"],200);
    }
    public function edit(EditVacationRequest $request,$id)
    {
        $request->validated();
        $user = Auth::user();
        $vacation = Vacation::find($id);
        if($vacation){
            if($request->hasFile("image")){
                $file = $request->file("image");
                $path = $file->store('public/vacation');
                $asset = "https://". $request->getHttpHost()."/".$path;
                $request->merge(['asset' => $asset]);
                $path = explode("https://". $request->getHttpHost()."/",$vacation->asset)[1];
                Storage::delete($path);
            }
            if($vacation->status == 0){
                $vacation->update($request->all());
            }
            return response()->json(["success"=>false,"message"=>"updated successfuly"],200);
        }else{
            return response()->json(["success"=>false,"message"=>"there are not vacation"],200);
        }
    }
    public function delete(Request $request,$id)
    {
        $user = Auth::user();
        $vacation = Vacation::find($id);
        if($vacation && $vacation->status == 0){
            if($vacation->asset)
            {
                $path = explode("https://". $request->getHttpHost()."/",$vacation->asset)[1];
                Storage::delete($path);
            }
            $vacation->delete();
            return response()->json(["success"=>true,"message"=>"deleted successfulf"],200);
        }else{
            return response()->json(["success"=>false,"message"=>"deleted failed"],200);
        }
    }
}