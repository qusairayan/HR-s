<?php



namespace App\Http\Livewire\Deductions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Department;
use App\Models\Deductions;
use App\Models\Allownce;
use App\Models\User;
use Livewire\WithPagination;

use Livewire\Component;

use Illuminate\Support\Facades\DB;


class DeductionsController extends Component
{
    use WithPagination;

    public $paginator = 10;
    public $search = '';
    public $employee = '';
    public $from = '';
    public $to = '';
    public $department = '';









    public function approve($id)
    {
        $deduction = Deductions::findOrFail($id);
        $deduction->status = 1;
        $deduction->save();
    }

    public function render()
    {
        $violationQuery = DB::connection('LYONDB')
        ->table('employee_traffic_violation')
        ->join('attendence1.users as users', 'users.name', '=', 'employee_traffic_violation.employee_name')
        ->select('users.phone','employee_traffic_violation.*', 'employee_traffic_violation.violation_date as date');

        $violations = $violationQuery->get();



        $deductions = Deductions::leftJoin('users', 'deductions.user_id', '=', 'users.id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id')
            ->select('deductions.*', 'users.name as user_name', 'users.image as user_image', 'department.name as department_name',)
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->get();


        return view('livewire.deductions.deductions', compact('deductions','violations'));
    }
}
