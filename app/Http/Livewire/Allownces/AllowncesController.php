<?php



namespace App\Http\Livewire\Allownces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Department;
use App\Models\Allownce;
use App\Models\User;
use Livewire\WithPagination;

use Livewire\Component;


class AllowncesController extends Component
{
use WithPagination;

public $paginator=10;
public $search ='';
public $amount;
public $userId;
public $date ;
public $type ;
protected $rules = [
    'amount' => 'required|numeric',
    'userId' => 'required|numeric',
    'date' => 'required|date',
    'type' => 'required|numeric',
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
            ->paginate($this->paginator ); 
    return view('livewire.allownces.allownces',compact('allownces',"users"));
}
public function addAllownces(){
    $this->validate();
    Allownce::create([
        "user_id"=>$this->userId ,
         "amount"=>$this->amount ,
         "date"=>$this->date  ,
         "type"=>$this->type  ,
    ]);
    return redirect("allownces");
}



}