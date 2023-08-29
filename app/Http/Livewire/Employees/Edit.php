<?php

namespace App\Http\Livewire\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Department;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;




class Edit extends Component
{
    use WithFileUploads;

    public $user;


    public $showSavedAlert = false;
    public $showDemoNotification = false;
    public $username ;
    public $name ;
    public $ID_no ;
    public $gender ;
    public $phone ;
    public $email ;
    public $birthday ;
    public $address ;
    public $image;
    public $status ;
    public $salary ;
    public $type = 1;
    public $company_id ;
    public $department_id ;
    public $position ;
    public $role ;


    public $newImage;


    public $rules = [
        
        'name' => 'required',
        'username' => 'required',
        'email' => 'required',
        'gender' => 'required',
        'company_id' => 'required',
        'department_id' => 'required',
        'position' => 'required',
        'role' => 'required',
        'salary' => 'required|integer',
        'type' => 'required|integer',
        'birthday' => 'date',
        'ID_no' => 'required|integer|digits:10', 

    ];
  

    public function mount(User $user)
    {
        
        
        $this->user = $user;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->gender = $user->gender;
        $this->company_id = $user->company_id;
        $this->department_id = $user->department_id;
        $this->position = $user->position;
        $this->salary = $user->salary;
        $this->type = $user->type;
        $this->birthday = $user->birthday;
        $this->ID_no = $user->ID_no;
        $this->status = $user->status;
        $this->image = $user->image;

        $this->role = $user->getRoleNames();

    
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedUsername()
    {
        $this->validate(
            ['username' =>  'unique:users,username,' . $this->user->id],   
        );

    }

    public function updatedEmail()
    {
        $this->validate(
            ['email' => 'email:rfc,dns|unique:users,email,' . $this->user->id]
        );

    }

    public function updatedImage()
    {
        if ($this->image) {
            $validExtensions = ['jpg', 'jpeg', 'png'];
            $extension = strtolower($this->image->getClientOriginalExtension());
    
            if (!in_array($extension, $validExtensions)) {
                $this->reset('image');
                $this->addError('image', 'Invalid image format. Only JPG, JPEG, and PNG images are allowed.');
                return;
            }
    
            $imageName = $this->user->id . '.' . $extension;
            $imagePath = 'public/profile/' .  $imageName;
    
            if ($this->user->image && Storage::exists('public/profile/' . $this->user->image)) {
                Storage::delete($imagePath);
            }
    
            // Save the new image with the unique name
            $this->image->storeAs('public/profile/', $imageName);
    
            $this->user->image = $imageName;

            $this->user->save();
    
            $this->newImage = asset('storage/profile/' . $this->user->image);
        }
    }
    


    public function save()
{
 
    $this->validate();

    $this->status = $this->status ? 1 : 0;

    $this->email = $this->email ?: null;
    

    $this->user->update([
        'email' => $this->email,
        'username' => $this->username,
        'name' => $this->name,
        'gender' => $this->gender,
        'company_id' => $this->company_id,
        'department_id' => $this->department_id,
        'position' => $this->position,
        'salary' => $this->salary,
        'type' => $this->type,
        'birthday' => $this->birthday,
        'ID_no' => $this->ID_no,
        'status' => $this->status,
    ]);

    $this->user->syncRoles($this->role);

    session()->flash('message', 'Profile updated successfully.');
    $this->showSavedAlert = true;
    return redirect('/employees');

}


    public function render()
    {
        $departments = Department::all();
        $companies = Company::all();
        $roles= Role::all();

        return view('livewire.employees.edit', compact('departments','companies','roles'));
    }
}
