<?php



namespace App\Http\Livewire\Salaries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Salary;
use App\Models\Promotion;
use App\Models\Company;
use App\Models\Bank;

use App\Models\User;
use Livewire\WithPagination;

use Livewire\Component;


class AddSalaries extends Component
{
    use WithPagination;

    public $showSavedAlert = false;
    public $showDemoNotification = false;



    public $employee = '';

    public $employeeName = '';
    public $ID_no = '';

    public $type = '';
    public $salarytype = '';
    public $period = '';
    public $salary = '';
    public $company = '';
    public $department = '';
    public $departmentName = '';

    public $position = '';
    public $bank = '';
    public $IBAN = '';
    public $status = 0;



    public $image = '';





    public $part_search = '';



    protected $rules = [
        'department' => 'required|exists:department,id',
        'company' => 'required|exists:company,id',
        'employee' => 'required|exists:users,id',
        'salary' => 'required|numeric',
        'IBAN' => 'required',
        'bank' => 'required|exists:banks,id',
    ];

    public function updated()
    {
        if ($this->employee != '') {

            $user = User::select('users.name', 'users.position', 'users.type', 'users.salary', 'users.image', 'department.name as departmentName')
                ->leftJoin('department', 'users.department_id', '=', 'department.id')
                ->where('users.id', '=', $this->employee)
                ->first();

            $this->employeeName = $user->name;
            $this->position = $user->position;
            $this->image = $user->image;
            $this->departmentName = $user->departmentName;
            $this->type = $user->type;


            if ($user->type == "full-time") {
                $this->period = 'monthly';

                $salary = Promotion::where('user_id', '=', $this->employee)->orderBy('from', 'desc')->first();

                if ($salary) {
                    $this->salary = $salary->salary;
                } else {
                    $this->salary = $user->salary;
                }
            }
        }
        $this->validate([
            'department' => 'required|exists:department,id',
            'company' => 'required|exists:company,id',
            'employee' => 'required|exists:users,id',
            'salary' => 'required|numeric',
            'IBAN' => 'required',
            'bank' => 'required|exists:banks,id',
        ]);
    }


    public function add()
    {

        $salary = Salary::create([
            'user_id' => $this->employee,
            'type' => $this->period,
            'salry' => $this->salary,
            'bank' => $this->bank,
            'amount' => $this->salary,
            'IBAN' => $this->IBAN,
            'status' => $this->status,

        ]);

        $salary->save();


        $this->showSavedAlert = true;
        redirect(route('payroll.salaries'));
    }





    public function render()
    {
        $companies = Company::all();

        $departments = Department::leftJoin('company', 'company.id', '=', 'department.company_id')
            ->select('department.*', 'company.name as company_name')
            ->where('company.id', '=', $this->company)
            ->get();


        $banks = Bank::all()->where('company_id', '=', $this->company);






        $usersWithoutSalaries = DB::table('users')
            ->leftJoin('salaries', 'users.id', '=', 'salaries.user_id')
            ->whereNull('salaries.user_id')
            ->select('users.*')
            ->where('users.department_id', '=', $this->department)
            ->get();



        return view('livewire.salaries.addSalary', compact('departments', 'companies', 'banks', 'usersWithoutSalaries'));
    }



    public function part_time()
    {

        $partimeQuery = User::select(
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

        if ($this->part_search) {
            $partimeQuery->where('users.name', 'LIKE', '%' . $this->part_search . '%')
                ->orWhere('company.name', 'LIKE', '%' . $this->part_search . '%')
                ->orWhere('department.name', 'LIKE', '%' . $this->part_search . '%');
        }



        $partime = $partimeQuery->get();
        dd($partime);

        return view('livewire.part_time.view', compact('partime'));
    }
}
