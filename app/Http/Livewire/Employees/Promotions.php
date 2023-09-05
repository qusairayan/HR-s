<?php

namespace App\Http\Livewire\Employees;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lateness;
use App\Models\Deductions;

use Livewire\Component;
use Livewire\WithPagination;

class Promotions extends Component
{
    use WithPagination;


    public $search = '';
    public $company='';
    public $department='';
    public $user = '';
    public $user_id = '';
    

    

    public function render()
    {

        $promotions = Lateness::leftJoin('users', 'promotions.user_id', '=', 'users.id')
            ->leftJoin('department', 'department.id', '=', 'users.department_id')
            ->select('promotions.*', 'users.name as user_name', 'department.name as department_name')
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->where('attendence.date', 'LIKE', '%' . $this->search . '%')
            ->paginate(10); 
           


        return view ('livewire.employees.promotions',['promotions'=>$promotions]);
    }





}
