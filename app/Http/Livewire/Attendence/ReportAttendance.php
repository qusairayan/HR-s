<?php

namespace App\Http\Livewire\Attendence;

use App\Models\User;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class ReportAttendance extends Component
{
    public $userId;
    public function mount(string $id)
    {
        $this->userId = $id;
    }
    public function render()
    {
        $user = User::join('department', 'users.department_id', '=', 'department.id')
        ->join('company', 'company.id', '=' ,'users.company_id')
        ->select('users.*', 'department.name as department_name','company.name as company_name')
        ->where('users.id',$this->userId)->first();

        // $attendanceList = User::join('department', 'users.department_id', '=', 'department.id')
        // ->join('company', 'company.id', '=' ,'users.company_id')
        // ->select('users.*', 'department.name as department_name','company.name as company_name')
        // ->where('users.id',$this->userId)->first();
        return view('livewire.attendence.report-attendance',["user"=>$user]);
    }
}
