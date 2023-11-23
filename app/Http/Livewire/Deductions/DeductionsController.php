<?php



namespace App\Http\Livewire\Deductions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Deductions;
use App\Models\TrafficViolations;
use App\Models\Allownce;
use App\Models\deduction_allowances_types;
use App\Models\User;
use Livewire\WithPagination;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DeductionsController extends Component
{
    use WithPagination;

    public $amount;
    public $userId;
    public $date ;
    public $type ;
    public $paginator = 10;
    public $search = '';
    public $employee = '';
    public $from = '';
    public $to = '';
    public $department = '';
    public $typeDeduction = '';


    protected $rules = [
        'amount' => 'required|numeric',
        'userId' => 'required|numeric',
        'date' => 'required|date',
        'type' => 'required|string',
    ];






    public function approve($deduction)
    {
        if(isset($deduction['violation_number'])){
            Deductions::create([
                "user_id"=>$deduction["user_id"],
                "type"=>1 ,
                 "amount"=>$deduction["amount"],
                 "date"=>$deduction["date"],
                 "detail"=>$deduction["violation_reason"],
                 "status"=>1,
            ]);
            $deduction = TrafficViolations::findOrFail($deduction["id"]);
            $deduction->status = 1;
            $deduction->save();
        }
        else {
            $deduction = Deductions::findOrFail($deduction["id"]);
            $deduction->status = 1;
            $deduction->save();
        }

    }

    public function render()
    {
        $users = User::all()->where('status', '=', 1);
        $violationQuery = TrafficViolations::leftJoin('users', 'users.name', '=', 'traffic_violations.name')
        ->leftJoin('department', 'department.id', '=', 'users.department_id')
        ->where("traffic_violations.status","=",false)
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
            $types = deduction_allowances_types::where("type",0)->get();
            dd($mergedPaginatedResults);
            return view('livewire.deductions.deductions', compact('mergedPaginatedResults','users',"types"));
    }
    public function addDeduction(){
        $err = $this->validate();
        Deductions::create([
            "user_id"=>$this->userId ,
             "amount"=>$this->amount ,
             "date"=>$this->date  ,
             "type"=>$this->type  ,
        ]);
        return redirect("deductions");
    }
    public function addTypeDeduction(){
        $this->rules = [
            'typeDeduction'=>"required|string|min:3|max:255|unique:deduction_allowances_types,name",
        ];
        $this->validate();
        deduction_allowances_types::create([
            'type'=>false,
            "name"=>$this->typeDeduction,
        ]);
        return redirect()->route("deductions");
    }
}
