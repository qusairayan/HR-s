<?php

namespace App\Http\Livewire\Schedule;

use App\Http\Livewire\Users;
use App\Models\User;
use App\Models\Department;
use App\Models\Shift;
use App\Models\Schedules;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class SetSchedule extends Component
{
    use WithPagination;

    public $user;

    public $department = 1;
    public $week = 1;

    public $dateSelects = [];

    public $shift = [];
    public $shifts = [];
    public $shiftsHTML;


    public $today;
    public $endOfWeek;
    public $totalDays;


    public $search;

    protected $rules = ['user' => 'required'];

    public $showSavedAlert = false;


    public function updated()
{
    $this->showSavedAlert = false;

}

    public function save()
    {
 $this->validate([
            'user' => 'required'
        ]);
        if (count($this->shift) < $this->totalDays) {
            $this->addError('shift', 'All shift selections must be filled.');
            return;
        }
       
        
        foreach ($this->shift as $date => $shiftId) {

            $dateD = new \DateTime($date);
            $day = $dateD->format('l');
           $off_day='';
            if ($shiftId == 'off') {
                $off_day=$date;
                $shiftId=null;
            }

            Schedules::create([
                'user_id' => $this->user,
                'date' => $date,
                'shift' => $shiftId,
                'day' => $day,
                'off-day' => $off_day,
            ]);
            $this->showSavedAlert = true;
            session()->flash("success", "Shift schedule created successfully.");
            $this->render();
            

        }
    }




    public function render()
    {

if($this->user != null){
        $preSchedule = Schedules::where('user_id', '=', $this->user)
        ->whereDate('date', '>', date('Y-m-d'))
        ->latest('id') // Order the records by date in descending order
        ->first();      // Retrieve the first (latest) record that matches the conditions

    if ($preSchedule) {
        $this->today = new \DateTime($preSchedule->date);
    } else {
        $this->today = new \DateTime();
    }
           $this->today->modify('+1 day');

           $this->endOfWeek = clone $this->today; 
           $this->endOfWeek->modify('next Saturday');

        $this->shifts = Shift::all();
        $this->shiftsHTML = '<option selected hidden value="">Shift</option>';
        foreach ($this->shifts as $shift) {
            $this->shiftsHTML .= '<option value="' . $shift['id'] . '">' . $shift['name'] . '</option>';
        }
        $this->shiftsHTML .= '<option value="off">Off Day</option>';

        if (auth()->user()->hasPermissionTo('setSchedule')) {
            $departments = Department::all();

            $users = User::leftJoin('department', 'department.id', '=', 'users.department_id')
                ->select('users.*', 'users.name as user_name', 'department.name as department_name')
                ->where('users.department_id', '=', $this->department)
                ->where('users.name', 'LIKE', '%' . $this->search . '%')->get();

            return view('livewire.schedule.setSchedule', compact('users','departments'));
        } else if (auth()->user()->hasPermissionTo('setDepSchedule')) {

                $this->department = auth()->user()->department_id;
            
    
            $users = User::leftJoin('department', 'department.id', '=', 'users.department_id')
                ->select('users.*', 'users.name as user_name', 'department.name as department_name')
                ->where('users.department_id', '=', $this->department)
                ->where('users.name', 'LIKE', '%' . $this->search . '%')->get();
            return view('livewire.schedule.setSchedule', compact('users'));
        }
        else{
            return view('404');

        }
    }

    else{
        if (auth()->user()->hasPermissionTo('setSchedule')) {
            $departments = Department::all();

            $users = User::leftJoin('department', 'department.id', '=', 'users.department_id')
                ->select('users.*', 'users.name as user_name', 'department.name as department_name')
                ->where('users.department_id', '=', $this->department)
                ->where('users.name', 'LIKE', '%' . $this->search . '%')->get();

            return view('livewire.schedule.setSchedule', compact('users','departments'));
        } else if (auth()->user()->hasPermissionTo('setDepSchedule')) {

                $this->department = auth()->user()->department_id;
            
    
            $users = User::leftJoin('department', 'department.id', '=', 'users.department_id')
                ->select('users.*', 'users.name as user_name', 'department.name as department_name')
                ->where('users.department_id', '=', $this->department)
                ->where('users.name', 'LIKE', '%' . $this->search . '%')->get();
            return view('livewire.schedule.setSchedule', compact('users'));
        }
        else{
            return view('404');
        }
    }


    



    }
}
