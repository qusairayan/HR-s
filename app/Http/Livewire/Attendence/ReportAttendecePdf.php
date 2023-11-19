<?php

namespace App\Http\Livewire\Attendence;

use App\Models\Attendence;
use App\Models\Lateness;
use App\Models\Schedules;
use App\Models\User;
use Livewire\Component;
use Mpdf\Mpdf;

use function PHPSTORM_META\map;

class ReportAttendecePdf extends Component{
  private $totalCheckIn =0 ;
  private $totalCheckOut =0 ;
  private $totalCountHour =0 ;
  private $totalCountHourEmployee =0 ;
  private $overTimeCheckIn =0 ;
  private $overTimeCheckOut =0 ;
    public $userId;
    public $date;
    public function mount($id, $date){
        $this->userId =$id ;
        $this->date = $date;
    }
    public function render(){
        $user=User::where('id','=',$this->userId)->first();
        $employee=$user->name;
        $image=$user->image;
        $position=$user->position;
        $employee_id=$user->id;
        $company=$user->company->name;
        $department=$user->department->name;
       $attendanceList = Schedules::
       leftJoin("attendence",function($join){
        $join->on('schedule.date', '=', 'attendence.date')
        ->on('schedule.user_id', '=', 'attendence.user_id');
       })
        ->leftJoin("leaves",function($join){
          $join->on('schedule.date', '=', 'leaves.date')
          ->on('schedule.user_id', '=', 'leaves.user_id');
        })
        ->leftJoin("vacations",function($join){
          $join->on('schedule.date', '=', 'vacations.date')
          ->on('schedule.user_id', '=', 'vacations.user_id');
        })
        ->select(
            "schedule.date as schedule_date",
            "schedule.day as day",
            "schedule.off-day as off",
            "schedule.from as start_work",
            "schedule.to as end_work",
            "attendence.check_in as check_in",
            "attendence.check_out as check_out",
            "vacations.date as vacation_date",
            "leaves.date as leaves_date",
            "leaves.time as leaves_time",
            "leaves.reason as leaves_reason",
            )->where('schedule.user_id',"=",$this->userId)
            ->where("schedule.date",'LIKE',$this->date.'-%')
            ->orderBy("schedule.date")
            ->get();
            if(!$attendanceList->isEmpty()){
              $attendanceList = $this->attendance($attendanceList);
              if($this->totalCheckIn > $this->overTimeCheckIn)$this->totalCheckIn = $this->totalCheckIn - $this->overTimeCheckIn;
              else $this->totalCheckIn =$this->overTimeCheckIn - $this->totalCheckIn;
              $attendanceList->totalCheckIn = gmdate("H:i:s", $this->totalCheckIn);
              if($this->totalCheckOut > $this->overTimeCheckOut)$this->totalCheckOut = $this->totalCheckOut - $this->overTimeCheckOut;
              else $this->totalCheckOut =$this->overTimeCheckOut - $this->totalCheckOut;
              $attendanceList->totalCheckOut = gmdate("H:i:s", $this->totalCheckOut);
              $this->totalCountHour = $this->convertToHours($this->totalCountHour);
              $attendanceList->totalCountHour = $this->totalCountHour;
              $this->totalCountHourEmployee = $this->convertToHours($this->totalCountHourEmployee);
              $attendanceList->totalCountHourEmployee = $this->totalCountHourEmployee;
              
            }
        $mpdf = new Mpdf([
          'mode' => 'utf-8',
          'format' => 'A4-L',
          'margin_left' => 10, 
          'margin_right' => 10, 
          'margin_top' => 10, 
          'margin_bottom' => 10, 
      ]);
      $mpdf->WriteHTML(view('livewire.attendence.report-attendece-pdf',["date"=>$this->date,'attendanceList'=>$attendanceList,"employee"=>$employee,'employee_id' => $employee_id,'company' => $company,'image' => $image,'department' => $department,'position' => $position]));
      $mpdf->showImageErrors = true;
      $mpdf->Output('document.pdf', 'I');
      exit;
    }
    private function attendance(object $object):object{
      $object =  $object->map(function($obj){
        if(!$obj->off)$obj->type = "Work Day";
        if($obj->off)$obj->type = "Week End";
        if($obj->vacation_date)$obj->type = "Vacation Day";
        if($obj->leaves_date)$obj->type = "Leaves Day";
          if($obj->check_in){
            if($obj->start_work < $obj->check_in){
              $obj->checkIn_late = $this->late($obj->check_in,$obj->start_work);
              $this->totalCheckIn += strtotime($obj->checkIn_late) - strtotime('TODAY');
            }
            else {
              $obj->overTimeCheckIn = $this->late($obj->start_work,$obj->check_in);
              $this->overTimeCheckIn += strtotime($obj->overTimeCheckIn) - strtotime('TODAY');
            } 
          }
          if($obj->check_out){
            if($obj->end_work < $obj->check_out){
              $obj->overTimeCheckOut = $this->late($obj->check_out,$obj->end_work);
              $this->overTimeCheckOut += strtotime($obj->overTimeCheckOut) - strtotime('TODAY');
            }
            else{
              $obj->checkOut_late = $this->late($obj->end_work,$obj->check_out);
              $this->totalCheckOut += strtotime($obj->checkOut_late) - strtotime('TODAY');
            }
          }
          if(!$obj->off){
            $obj->countHoursWork =  $this->late($obj->end_work,$obj->start_work);
          }
          
          if(!$obj->off)$this->totalCountHour += strtotime($obj->countHoursWork) - strtotime('TODAY'); 
          if($obj->check_out && $obj->check_in){
            $obj->countHoursWorkEmployee = $this->late($obj->check_out,$obj->check_in);
            if($obj->type == "Work Day" || $obj->type=="Leaves Day")$this->totalCountHourEmployee += strtotime($obj->countHoursWorkEmployee) - strtotime('TODAY');
          }
          return $obj;
      });
      return $object;
    }
    private function late(string $startTime ,string $endTime):string{
      $startTime =strtotime($startTime);
      $endTime =strtotime($endTime);
      return date("H:i:s",$startTime - $endTime);
    }
    private function convertToHours($time){
      return floor($time / 60 /60 );
    }
}
