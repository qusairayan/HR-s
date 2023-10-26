<?php
namespace App\Http\Livewire\Attendence;
use App\Models\Attendence;
use App\Models\Lateness;
use App\Models\Schedules;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Mpdf\Mpdf;
class ReportAttendance extends Component
{
    public $userId;
    public $date;
    public function mount($id, $date)
    {
        $this->userId =$id ;
        
        $this->date = $date;
    }
    public function render()
    {
        $user=User::where('id','=',$this->userId)->first();
        $employee=$user->name;
        $image=$user->image;
        $position=$user->position;
        $employee_id=$user->id;
        $company=$user->company->name;
        $department=$user->department->name;
        $attendanceList = Attendence::
          leftJoin('overtime','attendence.id','=','overtime.attendence_id')
          ->leftJoin('schedule','attendence.date','=','schedule.date')
          ->select(
            "attendence.*",
            "overtime.amount as overtime_amount",
            "overtime.allownce as overtime_allownce",
            "schedule.from as work_from",
            "schedule.to as work_to")
        ->where('attendence.user_id',$this->userId)
        ->where("attendence.date",'LIKE',$this->date.'-%')
        ->get();
            $attendanceList = $attendanceList->map(function ($record) {
              $lateness = Lateness::where("attendence_id",$record->id)->get();
              if($lateness->count()>0){
                foreach($lateness as $lat){
                  if($lat->on == "cehckIn"){
                    $record->amount_checkin = $lat->amount;
                    if($lateness->count() == 1) return $record;
                  }else{
                    $record->amount_checkout = $lat->amount;
                    return $record;
                  }
                }
              }
            });
        $mpdf = new Mpdf([
          'mode' => 'utf-8',
          'format' => 'A4-L',
          'margin_left' => 10, 
          'margin_right' => 10, 
          'margin_top' => 10, 
          'margin_bottom' => 10, 
      ]);
      
      $mpdf->WriteHTML(view('livewire.attendence.report-attendance',["date"=>$this->date,'attendanceList'=>$attendanceList,"employee"=>$employee,'employee_id' => $employee_id,'company' => $company,'image' => $image,'department' => $department,'position' => $position]));
      $mpdf->showImageErrors = true;
      $mpdf->Output('document.pdf', 'I');
      exit;
    }
}
