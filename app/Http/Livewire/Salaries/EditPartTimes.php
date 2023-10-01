<?php



namespace App\Http\Livewire\Salaries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Salary;
use App\Models\Promotion;
use App\Models\Company;
use App\Models\PartTime;

use App\Models\User;
use Livewire\WithPagination;
use Carbon\Carbon;

use Livewire\Component;


class EditPartTimes extends Component
{

    public $showSavedAlert = false;
    public $showDemoNotification = false;


    public $parttime;



    public $company = '';
    public $employee = '';
    public $employee_id = '';



    public $from = '';
    public $to = '';


    public $salary = 0;
    public $total = 0.0;



    public $part_search = '';
    public $noSalary = false;
    public $period = '';
    public $dateSet = false;
    public $date_incorrect = false;



    public function mount(PartTime $parttime)
    {
        $this->parttime = $parttime;
        $user = User::where('id', '=', $parttime->user_id)->first();

        $this->employee = $user->name;
        $this->employee_id = $user->id;
        $this->total = $parttime->amount;
        $this->from = $parttime->from;
        $this->to = $parttime->to;
    }
    public function updated()
    {


        $this->validate([
            'from' => 'required|date',
            'to' => 'required|date',
        ]);




        $salary = Salary::where('user_id', '=', intval($this->employee_id))->first();
        $this->noSalary = true;

        if ($salary) {
            $this->period = $salary->type;
            $this->salary = $salary->amount;
            $this->noSalary = false;
        } else {
            $this->period = '';
            $this->noSalary = true;
        }






        // Assuming you have two date values as Carbon objects
        if ($this->from && $this->to) {
            $this->dateSet = false;



            $from = Carbon::parse($this->from);
            $to = Carbon::parse($this->to);


            If($to <= $from ){
                $this->date_incorrect = true;
            return false;

            }
            else{
                $this->date_incorrect = false;
            }
            $daysDifference = $from->diffInDays($to);


            if ($this->period == 'daily') {
                $this->total =  round($this->salary * $daysDifference, 1);
            } else if ($this->period == 'weekly') {
                $this->total =  round($this->salary / 7 * $daysDifference, 1);
            } else if ($this->period == 'monthly') {
                $this->total = round($this->salary / 30 * $daysDifference , 1);
            }
        }

    }


    public function add()
    {


        $this->validate([
            'from' => 'required',
            'to' => 'required',

        ]);

        $check = PartTime::where('user_id', '=', $this->employee)
            ->where(function ($query) {
                $query->whereBetween('from', [$this->from, $this->to])
                    ->orWhereBetween('to', [$this->from, $this->to]);
            })
            ->first();

        if ($check) {

            $this->dateSet = true;
            return false;
        }

        $from = Carbon::parse($this->from);
        $to = Carbon::parse($this->to);
        If($to <= $from ){
            $this->date_incorrect = true;
            return false;
        }


        $this->parttime->update([
            'from' => $this->from,
            'to' => $this->to,
            'status' => 1,
            'amount' => $this->total,


        ]);

        $this->parttime->save();


        $this->showSavedAlert = true;
        redirect(route('payroll.part_time'));
    }

    public function render()
    {

        

        return view('livewire.salaries.editPartTime');
    }
}
