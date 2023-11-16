<?php

namespace App\Http\Livewire\Attendence;

use App\Models\Attendence;
use App\Models\Lateness;
use App\Models\Schedules;
use App\Models\User;
use Livewire\Component;
use Mpdf\Mpdf;
class ReportAttendecePdf extends Component{
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
       $attendanceList = Schedules::leftJoin("attendence","schedule.date","=","attendence.date")
        ->leftJoin("leaves","schedule.date","=","leaves.date")
        ->leftJoin("vacations","schedule.date","=","vacations.date")
        ->select(
            "schedule.date as schedule_date",
            "schedule.day as day",
            "schedule.off-day as off",
            "schedule.from as start_work",
            "schedule.to as end_work",
            "attendence.check_in as check_in",
            "attendence.check_out as check_out",
            "attendence.check_out as check_out",
            "vacations.date as vacation_date",
            "leaves.date as leaves_date",
            "leaves.time as leaves_time",
            "leaves.reason as leaves_reason",
            )->where('schedule.user_id',$this->userId)
            ->where("schedule.date",'LIKE',$this->date.'-%')
            ->orderBy("schedule.date")
            ->get();
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
}
