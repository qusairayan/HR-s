<?php

namespace App\Http\Livewire\Employees;

use Illuminate\Http\Request;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;


    public $search = '';

    public function render()
    {
        $users = User::leftJoin('department', 'users.department_id', '=', 'department.id')
            ->leftjoin('company', 'company.id', '=' ,'users.company_id')
            ->select('users.*', 'department.name as department_name','company.name as company_name')
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->latest()
            ->paginate(10); // Adjust the pagination limit as per your requirement
        return view('livewire.employees.employees', ['users' => $users]);
    }





    public function Remove(User $user)
    {
        $user->delete();
        return redirect()->route('employees');
    }
}
