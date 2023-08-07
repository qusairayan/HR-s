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


class DeductionsController extends Component
{
use WithPagination;

public $paginator=10;
public $search ='';









public function approve($id){
    $deduction=Deductions::findOrFail($id);
    $deduction->status=1;
    $deduction->save();
}

public function render(){
    
    $deductions = Deductions::leftJoin('users', 'deductions.user_id', '=', 'users.id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id')
            ->select('deductions.*', 'users.name as user_name', 'users.image as user_image', 'department.name as department_name', )          
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->paginate($this->paginator ); 
    return view('livewire.deductions.deductions',compact('deductions'));

}




}