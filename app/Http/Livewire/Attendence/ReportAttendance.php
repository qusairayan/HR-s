<?php

namespace App\Http\Livewire\Attendence;

use App\Models\Attendence;
use App\Models\Lateness;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class ReportAttendance extends Component
{
    public $userId;
    public $date;
    public function mount(string $id)
    {
        $this->userId = $id;
        $this->date = date("y-m");
    }
    public function render()
    {
        $user = User::
          join('department', 'users.department_id', '=', 'department.id')
        ->join('company', 'company.id', '=' ,'users.company_id')
        ->select('users.*', 'department.name as department_name','company.name as company_name')
        ->where('users.id',$this->userId)->first();
 


        
        $attendanceList = Attendence::
        //   leftJoin('lateness','attendence.id','=','lateness.attendence_id')
          leftJoin('overtime','attendence.id','=','overtime.attendence_id')
        //   ->select("attendence.*","lateness.amount as late_amount","lateness.on as late_type","lateness.deduction as late_deduction","overtime.amount as overtime_amount","overtime.allownce as overtime_allownce")
          ->select("attendence.*","overtime.amount as overtime_amount","overtime.allownce as overtime_allownce")
        ->where('attendence.user_id',$this->userId)->get();
        $lateness = Lateness::where("attendence_id",1)->get();
//  dd($attendanceList);
        
        // $attendanceList = Attendence::where('user_id',$this->userId)->get();
        return view('livewire.attendence.report-attendance',["user"=>$user,"date"=>$this->date,'attendanceList'=>$attendanceList]);
    }
}
