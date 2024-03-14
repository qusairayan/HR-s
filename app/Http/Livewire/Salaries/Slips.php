<?php



namespace App\Http\Livewire\Salaries;

use App\Http\Livewire\Departments\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Company;
use App\Models\MonthlyPayroll;
use App\Models\PartTime;

use App\Models\User;
use Livewire\WithPagination;
use Carbon\Carbon;

use Livewire\Component;
use Mpdf\Mpdf;

class Slips extends Component
{
    use WithPagination;
    public $showSavedAlert = false;
    public $showDemoNotification = false;
    public $company = '';
    public $department = '';
    public $employee = '';
    public $date = '';
    public $from;
    public $to;
    public $MonthlyPayroll;
    public $search = '';
    public function report($id)
    {
        $res = MonthlyPayroll::find($id);
        $userId = $res->user_id;
        $month = explode("-", $res->month);
        $month = $month[0] . '-' . $month[1];
        return redirect()->route('payrolls.slip_report', ['id' => $userId, 'month' => $month]);
    }
    public function fullTimeReport()
    {
        $this->validate([
            'employee' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
        ]);
        return redirect()->route('payrolls.fullTimeReport', ['id' => $this->employee, 'from' => $this->from, "to" => $this->to])
            ->with(['newTab' => true]);
    }



    public function render()
    {
        $monthlyPayrollQuery = MonthlyPayroll::leftJoin("users", "monthly_payrolls.user_id", "users.id")
            ->leftJoin("salary_deposits", "monthly_payrolls.id", "salary_deposits.salary_id")
            ->select("monthly_payrolls.*", "users.name as name", "salary_deposits.id as salaryDepositId")
            ->orderby("month", "desc");
        $companies = Company::all();

        $departmentsQuery = Department::select('*');
        if ($this->company) {
            $departmentsQuery->where('company_id', '=', $this->company);
        }
        $departments = $departmentsQuery->get();


        $employeesQuery = User::select('*')->where('type', '=', 'full-time');
        if ($this->company) {
            $employeesQuery->where('company_id', '=', $this->company);
        }
        if ($this->department) {
            $employeesQuery->where('department_id', '=', $this->department);
        }
        $employees = $employeesQuery->get();
        if ($this->employee) {
            $monthlyPayrollQuery->where('user_id', '=', $this->employee);
            $monthlyPayrollQuery->employee = $this->employee;
        }
        if ($this->search) {
            $monthlyPayrollQuery->where('users.name', 'LIKE', '%' . $this->search . '%');
        }
        $payrolls = $monthlyPayrollQuery->get()->toArray();
        return view('livewire.salaries.slips', compact('companies', 'departments', 'employees', "payrolls"));
    }
    public function delete($id)
    {
        MonthlyPayroll::destroy($id);
    }
}
