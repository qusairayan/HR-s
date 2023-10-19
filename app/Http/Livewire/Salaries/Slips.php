<?php



namespace App\Http\Livewire\Salaries;

use App\Http\Livewire\Departments\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Company;
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


  




public function report(){
    

    $this->validate([
        'employee' => 'required',
        'date' => 'required|date',
    ]);

    return redirect()->route('payroll.slip_report',['id' => $this->employee, 'date' => $this->date])
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


        $employeesQuery = User::select('*')->where('type','=','full-time');
        if($this->company){
            $employeesQuery ->where('company_id','=',$this->company);
            }
            if($this->department){
                $employeesQuery ->where('department_id','=',$this->department);
                }
        $employees= $employeesQuery ->get();

        

        return view('livewire.salaries.slips', compact('companies', 'departments','employees'));
    }
}
