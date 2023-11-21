<?php

namespace App\Http\Livewire\Employees;

use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class VacationBalance extends Component
{
    public function render(){
        $companies = Company::all();
        $departments = Department::all();
        $departments = Department::all();
        $user = User::all();
        return view('livewire.employees.vacation-balance',["users"=>$user, "companies"=> $companies,"departments"=> $departments]);
    }
}
