<?php



namespace App\Http\Livewire\Salaries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Department;
use App\Models\Salary;
use App\Models\User;
use Livewire\WithPagination;

use Livewire\Component;


class Salaries extends Component
{
use WithPagination;

public $paginator=10;
public $search ='';

public function edit($id){
    $salary = Salary::leftJoin('users', 'salaries.user_id', '=', 'users.id')
            ->select('salaries.*', 'users.name as user_name', )          
            ->where('salaries.id', '=', $id)
            ->first(); 


            return view('livewire.salaries.editSalaries',compact('salary'));
    
}

public function remove($id){
    dd($id);
}
public function render(){
    
    $salaries = Salary::leftJoin('users', 'salaries.user_id', '=', 'users.id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id')
            ->leftJoin('banks', 'banks.id', '=', 'salaries.bank')
            ->select('salaries.*', 'users.name as user_name', 'users.image as user_image', 'department.name as department_name', )          
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->where('department.name', 'LIKE', '%' . $this->search . '%')
            ->paginate($this->paginator ); 

    
    return view('livewire.salaries.salaries',compact('salaries'));

}


public function view($id){
    
$salary = Salary::where($id)->first();

return view('livewire.salaries.view',compact('salary'));
}




}