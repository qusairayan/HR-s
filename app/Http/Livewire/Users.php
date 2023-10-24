<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        $users = User::leftJoin("department","users.department_id",'=',"department.id")->leftJoin("company",'users.company_id','=','company.id')->select('users.*', 'department.name as department_name','company.name as company_name')->paginate(10);
        return view('livewire.users',compact('users'));
    }

}
