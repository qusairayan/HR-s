<?php



namespace App\Http\Livewire\Allownces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Department;
use App\Models\Allownce;
use App\Models\deduction_allowances_types;
use App\Models\User;
use Livewire\WithPagination;

use Livewire\Component;


class AllowncesController extends Component
{
use WithPagination;

public $paginator=50;
public $search ='';
public $amount;
public $userId;
public $date ;
public $type ;
public $typeAllownces ;
protected $rules = [
    'amount' => 'required|numeric',
    'userId' => 'required|numeric',
    'date' => 'required|date',
    'type' => 'required|string',
];

public function approve($id){
    $alloence=Allownce::findOrFail($id);
    $alloence->status=1;
    $alloence->save();
}

public function render(){
    $users = User::all()->where('status', '=', 1);
    $allownces = Allownce::leftJoin('users', 'allownces.user_id', '=', 'users.id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id')
            ->select('allownces.*', 'users.name as user_name', 'users.image as user_image', 'department.name as department_name', )          
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->orderBy("allownces.date", "desc")
            ->paginate($this->paginator ); 
            $types = deduction_allowances_types::where("type",1)->pluck("name")->toArray();
    return view('livewire.allownces.allownces',compact('allownces',"users","types"));
}
public function addAllownces(){
    // dd($this->type);
    $this->validate();

    Allownce::create([
        "user_id"=>$this->userId ,
         "amount"=>$this->amount ,
         "date"=>$this->date  ,
         "type"=>$this->type  ,
    ]);
    return redirect("allownces");
}

public function addTypeAllownces(){
    $this->rules = [
        'typeAllownces'=>"required|string|min:3|max:255|unique:deduction_allowances_types,name",
    ];
    $this->validate();
    deduction_allowances_types::create([
        'type'=>true,
        "name"=>$this->typeAllownces,
    ]);
    return redirect()->route("allownces");
}
public function delete($id){
    Allownce::destroy($id);
    return redirect()->route("allownces");
}
}