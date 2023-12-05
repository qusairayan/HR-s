<?php



namespace App\Http\Livewire\Salaries;

use App\Http\Livewire\Users;
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


class AddPartTimes extends Component
{
    use WithPagination;

    public $showSavedAlert = false;
    public $showDemoNotification = false;

    public $paginator = 10;
    public $search = '';

    public $company = '';
    public $employee = '';



    public $from = '';
    public $to = '';


    public $salary = 0;
    public $total = 0.0;



    public $part_search = '';
    public $noSalary = false;
    public $period = '';
    public $dateSet = false;
    public $date_incorrect = false;




    public function updated()
    {


        $this->validate([
            'employee' => 'required|exists:users,id',
            'from' => 'required|date',

        ]);



        if ($this->employee) {
            $salary = User::where('id', '=', intval($this->employee))->first();
            $this->noSalary = true;

            if ($salary) {
                if ($salary->salary &&  $salary->part_time) {
                    $this->period = $salary->part_time;
                    $this->salary = $salary->salary;
                    $this->noSalary = false;
                }
            } else {
                $this->period = '';
                $this->noSalary = true;
            }
        }






        // Assuming you have two date values as Carbon objects
        if ($this->from && $this->to) {
            $this->dateSet = false;



            $from = Carbon::parse($this->from);
            $to = Carbon::parse($this->to);

            if ($to && $to <= $from) {
                $this->date_incorrect = true;
                return false;
            } else {
                $this->date_incorrect = false;
            }

            $daysDifference = $from->diffInDays($to);


            if ($this->period == 'daily') {
                $this->total =  round($this->salary * ($daysDifference + 1), 1)  ;
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
            'employee' => 'required|exists:users,id',
            'from' => 'required',

        ]);

        $from = Carbon::parse($this->from);
        $to = Carbon::parse($this->to);

        if ($to && $to <= $from) {
            $this->date_incorrect = true;
            return false;
        } else {
            $this->date_incorrect = false;
        }


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
        $status = 0;
        if ($this->from && $this->to) {
            $status = 1;
        }



        $PartTime = PartTime::create([
            'user_id' => $this->employee,
            'from' => $this->from,
            'to' => $this->to==''?null:$this->to,
            'status' => $status,
            'amount' => $this->total,


        ]);

        $PartTime->save();


        $this->showSavedAlert = true;
        redirect(route('payrolls.part_time'));
    }

    public function render()
    {

        $companies = Company::all();
        $departments = Department::all();
        $partimeQuery = User::select(
            'users.id',
            'users.name',
            'users.type',
            'department.name as dep_name',
            'company.name as comp_name',
            'salaries.amount',
            'salaries.type',
            'salaries.from',
            'salaries.to',
            'salaries.date'
        )
            ->leftJoin('salaries', 'salaries.user_id', '=', 'users.id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id')
            ->leftJoin('company', 'company.id', '=', 'users.company_id')->where('users.type', '=', 'part-time');

        if ($this->company) {
            $partimeQuery->where('users.company_id', '=', $this->company);
        }



        $partime = $partimeQuery->get();

        return view('livewire.salaries.addPartTime', compact('departments', 'companies', 'partime'));
    }
}
