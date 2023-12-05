<?php



namespace App\Http\Livewire\Salaries;

use App\Http\Livewire\Departments\Departments;
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


class PartTimes extends Component
{
    use WithPagination;

    public $showSavedAlert = false;
    public $showDemoNotification = false;

    public $paginator = 10;
    public $search = '';

    public $company = '';
    public $department = '';
    public $employee = '';


    public $from = '';
    public $to = '';


  




public function report(){
    

    $this->validate([
        'employee' => 'required',
        'from' => 'required|date',
        'to' => 'required|date',
    ]);

    return redirect()->route('payrolls.part_time_report',['id' => $this->employee, 'from' => $this->from, 'to' => $this->to])
    ->with(['newTab' => true]);

}



    public function render()
    {


        $companies = Company::all();

        $departmentsQuery = Department::select('*');
        if($this->company){
        $departmentsQuery ->where('company_id','=',$this->company);
        }
        $departments= $departmentsQuery ->get();


        $employeesQuery = User::select('*')->where('type','=','part-time');
        if($this->company){
            $employeesQuery ->where('company_id','=',$this->company);
            }
            if($this->department){
                $employeesQuery ->where('department_id','=',$this->department);
                }
        $employees= $employeesQuery ->get();

        

        $partimeQuery = PartTime::select(
            'part_times.id','users.name as user_name',
            'department.name as dep_name',
            'users.position',
            'users.department_id',
            'users.company_id',
            'part_times.from',
            'part_times.to',
            'part_times.status',
            'part_times.amount',  
        )
            ->leftJoin('users', 'users.id', '=', 'part_times.user_id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id');
        if ($this->company) {
            $partimeQuery->where('users.company_id', '=', $this->company);
        }
        if ($this->department) {
            $partimeQuery->where('users.department_id', '=', $this->department);
        }


        if ($this->from) {
            $partimeQuery->where('part_times.from', '>=', $this->from);
        }

        if ($this->to) {
            $partimeQuery->where('users.department_id', '<=', $this->to);
        }

        if ($this->search) {
            $partimeQuery->where('users.name', 'LIKE', '%'.$this->search.'%');
        }

        $partimeQuery->orderBy('part_times.status', 'asc');




        $partime = $partimeQuery->paginate( $this->paginator );
        

        return view('livewire.salaries.partTime', compact('companies', 'departments','employees','partime'));
    }
    public function delete($id){
        PartTime::destroy($id);
    }
}
