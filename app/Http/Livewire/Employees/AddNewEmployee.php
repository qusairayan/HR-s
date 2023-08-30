<?php

namespace App\Http\Livewire\Employees;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;


class AddNewEmployee extends Component
{
    use WithFileUploads;

    public $user;

    public $showSavedAlert = false;
    public $showDemoNotification = false;

    public $username = '';

    public $name = '';
    public $ID_no = '';
    public $gender = '';
    public $phone = '';
    public $email = '';
    public $birth = '';
    public $address = '';

    public $image;
    public $ID_image;
    public $license_image;

    public $password = '';
    public $passwordConfirmation = '';

    public $status = 0;

    public $salary = '';
    public $company = '';
    public $department = '';
    public $departmentName = '';


    public $position = '';
    public $type= ''; 
    public $role = '';
    public $start_date = '';



    protected $rules = [
        'password' => 'required|same:passwordConfirmation|min:6',
        'email' => 'email:rfc,dns|unique:users',
        'username' => ['required', 'unique:users', 'max:255'],
        'name' => 'required',
        'gender' => 'required',
        'company' => 'required',
        'department' => 'required',
        'position' => 'required',
        'type' => 'required',
        'role' => 'required',
        'salary' => 'required|integer',
        'start_date' => 'required|date',
        'ID_no' => 'required|int|digits:10',
        'image' => 'nullable|mimes:jpg,png,jpeg',
        'ID_image' => 'nullable|mimes:jpg,png,jpeg',
        'license_image' => 'nullable|mimes:jpg,png,jpeg',

    ];



    public function updatedUsername() {
        $this->validate(['username' => 'required|unique:users']);
    }



    public function updatedDepartment()
    {

        $this->departmentName = Department::find($this->department)->name;
    }


    public function updated($propertyName)
    {
        // $this->validateOnly($propertyName);
    }


    public function add()
    {

        $this->validate([
            'password' => 'required|same:passwordConfirmation|min:6',
            'username' => ['required', 'unique:users', 'max:255'],
            'name' => 'required',
            'gender' => 'required',
            'company' => 'required',
            'department' => 'required',
            'position' => 'required',
            'type' => 'required',
            'role' => 'required',
            'salary' => 'required|integer',
            'start_date' => 'required|date',
            'ID_no' => 'required|integer|digits:10',
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'ID_image' => 'nullable|mimes:jpg,png,jpeg',
            'license_image' => 'nullable|mimes:jpg,png,jpeg',

        ]);

        if ($this->email == '') {
            $this->email = null;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'company_id' => $this->company,
            'department_id' => $this->department,
            'remember_token' => Str::random(10),
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'position' => $this->position,
            'type' => $this->type,
            'salary' => $this->salary,
            'start_date' => $this->start_date,
            'ID_no' => $this->ID_no,
            'birthday' => $this->birth,
        ]);



        $user->assignRole($this->role);


        if ($this->image) {
            $imagePath = $this->image->storeAs('public/profile/', $user->id . '.' . $this->image->getClientOriginalExtension());

            $user->image = $user->id . '.' . $this->image->getClientOriginalExtension();
            $user->save();
        }

        if ($this->ID_image) {
            $imagePath = $this->ID_image->storeAs('public/profile/', 'ID_'.$user->id . '.' . $this->ID_image->getClientOriginalExtension());

            $user->ID_image = 'ID_'.$user->id . '.' . $this->ID_image->getClientOriginalExtension();
            $user->save();
        }

        if ($this->license_image) {
            $imagePath = $this->license_image->storeAs('public/profile/', 'license_'.$user->id . '.' . $this->license_image->getClientOriginalExtension());

            $user->license_image ='license_'.$user->id . '.' . $this->license_image->getClientOriginalExtension();
            $user->save();
        }


        return redirect('/employees');
    }

    public function render()
    {
$companies = Company::all();

        $departments = Department::leftJoin('company', 'company.id', '=', 'department.company_id')
            ->select('department.*', 'company.name as company_name')
            ->get();

        if($this->company !=''){
            $departments = Department::leftJoin('company', 'company.id', '=', 'department.company_id')
            ->select('department.*', 'company.name as company_name')->
            where('company_id','=',$this->company)
            ->get();
        }

        $roles = Role::all()->where('name', '!=', 'admin');


        return view('livewire.employees.addNewEmployee', compact('departments', 'companies', 'roles'));
    }
}
