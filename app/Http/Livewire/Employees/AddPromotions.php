<?php

namespace App\Http\Livewire\Employees;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Lateness;
use App\Models\Deductions;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class AddPromotions extends Component
{
    use WithPagination;


    public $company;
    public $department;


    public $user;
    public $salary = '';
    public $from = '';
    public $to = '';
    public $position = '';

    protected $rules = [
        'company' => 'required|numeric',
        'department' => 'required|numeric',
        'user' => 'required|numeric',
        'salary' => 'required|numeric',
        'from' => 'required|date',
        'position' => 'required',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {

        $this->validate([
            'company' => 'required|numeric',
            'department' => 'required|numeric',
            'user' => 'required|numeric',
            'salary' => 'required|numeric',
            'from' => 'required|date',
            'position' => 'required',

        ]);




        $prevPromo = Promotion::where('user_id', $this->user)->where('from', '<', $this->from)->orderBy('from', 'desc')->first();
        if($prevPromo){
            $prevPromo->to=$this->from;
            $prevPromo->save();
        }

        $promotion = Promotion::create([
            'user_id' => $this->user,
            'salary' => $this->salary,
            'from' => $this->from,
            'position' => $this->position,

        ]);

        $promotion->save();


        return redirect(route('promotions'));
    }
    public function render()
    {


        $companies = Company::all();

        $departments = Department::Where('company_id', '=', $this->company)->get();
        $users = User::Where('department_id', '=', $this->department)->get();


        return view('livewire.employees.addPromotions', ['companies' => $companies, 'departments' => $departments, 'users' => $users]);
    }
}
