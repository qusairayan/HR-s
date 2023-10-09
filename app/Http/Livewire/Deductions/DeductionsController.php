<?php



namespace App\Http\Livewire\Deductions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Deductions;
use App\Models\TrafficViolations;
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
        $violationQuery = TrafficViolations::leftJoin('users', 'users.name', '=', 'traffic_violations.name')
        ->leftJoin('department', 'department.id', '=', 'users.department_id')
        ->select('traffic_violations.*','department.name as department_name');

        if($this->from){
            $violationQuery = $violationQuery->where('traffic_violations.from','>=',$this->from);
        }
        if($this->to){
            $violationQuery = $violationQuery->where('traffic_violations.to','<=',$this->to);
        }

        $violations = $violationQuery->paginate(10);



        $deductionsQuery = Deductions::leftJoin('users', 'deductions.user_id', '=', 'users.id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id')
            ->select('deductions.*', 'users.name as user_name', 'users.image as user_image', 'department.name as department_name',)
            ->where('users.name', 'LIKE', '%' . $this->search . '%');
            
        
            if($this->from){
                $violationQuery = $violationQuery->where('deductions.from','>=',$this->from);
            }
            if($this->to){
                $violationQuery = $violationQuery->where('deductions.to','<=',$this->to);
            }
    
            $deductions = $deductionsQuery->paginate(10);
    
            $mergedResults = $violations->concat($deductions);

            $mergedPaginatedResults = new \Illuminate\Pagination\LengthAwarePaginator(
                $mergedResults,
                $mergedResults->count(),
                10
            );
        return view('livewire.deductions.deductions', compact('mergedPaginatedResults'));
    }
}
