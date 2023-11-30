<?php

namespace App\Http\Controllers\api\attendence;

use App\Http\Controllers\Controller;
use App\Models\Schedules;
use App\Models\Lateness;
use App\Models\Leave;
use App\Models\Overtime;
use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class AttendanceController extends Controller
{
    public function attendence(Request $request)
    {
        date_default_timezone_set('Asia/Amman');
        // validation
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'type' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Values.',
            ], 400);
        }

        $id = $request->input('id');
        $type = $request->input('type');

        try {
            $user = User::findOrFail($id);
            $currentDateTime = Carbon::now();
            $currentTime = $currentDateTime->format('H:i');
            $currentDate = $currentDateTime->format('Y-m-d');

            if ($type == 0) {
                // check if user made Attendance  
                $isChecked = Attendence::where('user_id', $id)->whereDate('date', '=', Carbon::now()->toDateString())->first();
                if ($isChecked) {
                    return response()->json([
                        'success' => false,
                        'message' => 'User has attendence for today',
                    ], 400);
                }
                // make new Attendance
                $attendence = new Attendence();
                $attendence->user_id = $id;
                $attendence->type = $type;
                $attendence->check_in  = $currentTime;
                $attendence->date = $currentDate;
                $success = $attendence->save();
                // get Work schedule for the user
                $scheduale = Schedules::select('*')
                    ->where('user_id', '=', $id)
                    ->where('date', '=', $currentDate)
                    ->first();
                $latenessTxt = '';
                // if user has work scheduale for current day 
                if ($scheduale) {
                    $from = strtotime($scheduale->from);
                    $fromDateTime = \DateTime::createFromFormat('H:i', date('H:i', $from));
                    $currentTime = \DateTime::createFromFormat('H:i', $currentTime);
                    if ($fromDateTime < $currentTime) {

                        $diff = $fromDateTime->diff($currentTime);
                        $totalMinutes = $diff->h * 60 + $diff->i;
            
                        if ($totalMinutes > 5) {
                            $lateness = new Lateness();
                            $lateness->user_id = $id;
                            $lateness->attendence_id = $attendence->id;
                            $lateness->amount = $totalMinutes;
                            $lateness->on = 'cehckIn';
                            $latenessSuc = $lateness->save();

                            if ($latenessSuc) {
                                $latenessTxt = ' , Lateness recorded Successfully';
                            }
                        }
                    }
                }
                if ($success) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Attendence recorded Successfully' . $latenessTxt,

                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Attendence recorded Failed.',

                    ], 400);
                }
            } else if ($type == 1) {

                $attendence = attendence::Where('user_id', '=', $id)->where('date', '=', $currentDate)->whereNotNull('check_in')->whereNull('check_out')->first();

                if ($attendence) {

                    $attendence->check_out = $currentTime;
                    $success = $attendence->save();
                    
                    $scheduale = Schedules::select('*')
                        ->where('user_id', '=', $id)
                        ->where('date', '=', $currentDate)
                        ->first();

                    $latenessTxt = '';

                    if ($scheduale) {
                        $to = strtotime($scheduale->to);

                        $toDateTime = \DateTime::createFromFormat('H:i', date('H:i', $to));
                        $currentTime = \DateTime::createFromFormat('H:i', $currentTime);

                        $diff = $currentTime->diff($toDateTime);
                        $totalMinutes = $diff->h * 60 + $diff->i;
                        $leaveMinDiff = 0;


                        if ($currentTime <= $toDateTime) {



                            if ($totalMinutes > 10) {


                                $leave = Leave::where('user_id', '=', $id)->where('date', '=', $currentDate)->where('status', '=', 1)->where('period', '>=', $totalMinutes)->first();
                                $isLeave = false;



                                if ($leave) {

                                    $leaveFromTemp = strtotime($leave->time);
                                    $leaveToTemp = strtotime($leave->period);

                                    $leaveFrom = \DateTime::createFromFormat('H:i', date('H:i', $leaveFromTemp));


                                    $hours = $leaveFrom->format('H');
                                    $minutes = $leaveFrom->format('i');

                                    $leaveToTemp = strtotime("+$hours hours", $leaveToTemp);
                                    $leaveToTemp = strtotime("+$minutes minutes", $leaveToTemp);


                                    $leaveTo = \DateTime::createFromFormat('H:i', date('H:i', $leaveToTemp));

                                    if ($leaveFrom <= $currentTime && $leaveTo >= $toDateTime) {
                                        $isLeave = true;
                                    } else {

                                        if ($leaveFrom >= $currentTime) {


                                            $diffLeave = $leaveFrom->diff($currentTime);
                                            if ($diffLeave->h * 60 + $diffLeave->i > 10) {
                                                $leaveMinDiff += $diffLeave->h * 60 + $diffLeave->i;
                                            } else {
                                                $isLeave = true;
                                            }
                                        }
                                        if ($leaveTo <= $toDateTime) {


                                            $diffLeave = $leaveTo->diff($toDateTime);
                                            if (($diffLeave->h * 60 + $diffLeave->i) > 10) {
                                                $leaveMinDiff += $diffLeave->h * 60 + $diffLeave->i;
                                            } else {
                                                $isLeave = true;
                                            }
                                        }
                                    }
                                }


                                if ($isLeave) {


                                    $attendence->type = 10;
                                    $success = $attendence->save();
                                } else {


                                    $lateness = new Lateness();
                                    $lateness->user_id = $id;
                                    $lateness->attendence_id = $attendence->id;
                                    if ($leaveMinDiff > 0) {
                                        $lateness->amount = $leaveMinDiff;
                                    } else {
                                        $lateness->amount = $totalMinutes;
                                    }
                                    $lateness->on = 'cehckOut';

                                    $latenessSuc = $lateness->save();

                                    if ($latenessSuc) {
                                        $latenessTxt = ' , Lateness recorded Successfully';
                                    }
                                }
                            }
                        }

                        if ($currentTime > $toDateTime) {
                            if ($totalMinutes > 10) {

                                $overtime = new Overtime();
                                $overtime->user_id = $id;
                                $overtime->attendence_id = $attendence->id;
                                $overtime->amount = $totalMinutes;

                                if ($overtime->save()) {
                                    $latenessTxt = ', Overtime Added';
                                }
                            }
                        }
                    }





                    if ($success) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Attendence recorded Successfully' . $latenessTxt,

                        ], 200);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Attendence recorded Failed.',

                        ], 400);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'There`s no Check in for user, Attendence recorded Failed.',

                    ], 400);
                }
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'User does not  exist .',
            ], 404);
        }
    }
}
