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
    public $type;
    public $department;
    public $user;
    public $salary = '';
    public $from = '';
    public $end = '';
    public $position = '';
    protected $rules = [
        'company' => 'required|numeric|exists:company,id',
        'department' => 'required|numeric|exists:department,id',
        'user' => 'required|numeric|exists:users,id',
        'salary' => 'required|numeric',
        'from' => 'required|date',
        'end' => 'date',
        'position' => 'required',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function create()
    {
        $this->validate([
            'company' => 'required|numeric|exists:company,id',
            'department' => 'required|numeric|exists:department,id',
            'user' => 'required|numeric|exists:users,id',
            'salary' => 'required|numeric',
            'from' => 'required|date',
            'end' => 'date',
            'position' => 'required',
        ]);
        $prevPromo = Promotion::where('user_id', $this->user)->where('from', '<', $this->from)->orderBy('from', 'desc')->first();
        if ($prevPromo) {
            $prevPromo->to = $this->from;
            $prevPromo->save();
        }
        $promotion = Promotion::create([
            'user_id' => $this->user,
            'department_id' => $this->department,
            'company_id' => $this->company,
            'salary' => $this->salary,
            'type' => 1,
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
        // $users = User::Where('department_id', '=', $this->department)->get();
        $users = User::all();
        return view('livewire.employees.addPromotions', ['companies' => $companies, 'departments' => $departments, 'users' => $users]);
    }
}
