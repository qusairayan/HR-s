<?php

namespace App\Http\Livewire\Permission;




use App\Models\Department;
use App\Models\Company;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Livewire\Component;





class PermissionEdit extends Component
{

    public $user;


    public $showSavedAlert = false;
    public $showDemoNotification = false;


    public $username;
    public $name;


    public $department;
    public $position;
    public $role;



    public $allPermissions;

    public $userPermissionSearch='';
    public $permissionSearch='';

    public $userAllPermissions;
    public $arrows='';



    public function mount(User $user)
    {


        $this->user = $user;
        $this->username = $user->username;
        $this->name = $user->name;
        $this->department = $user->department;
        $this->position = $user->position;

        $this->role = $user->getRoleNames();
    }




public function addPermission($name){

    $this->user->givePermissionTo($name);
    $this->arrows = '<div class="mid-arrow">
    <span></span>
    <span></span>
    <span></span>
</div>
';


}

public function removePermission($name){

    $this->user->revokePermissionTo($name);



}


    public function render()
    {


        $departments = Department::all();
        $companies = Company::all();
        $roles = Role::all();





        $this->userAllPermissions = $this->user->getDirectPermissions();





        $this->allPermissions = Permission::all();


       $this->allPermissions = $this->allPermissions->diff($this->userAllPermissions)->filter(function ($permission) {
        return strpos($permission->description, $this->permissionSearch) !== false;
    });
    $this->userAllPermissions= $this->userAllPermissions ->filter(function ($permission) {
        return strpos($permission->description, $this->userPermissionSearch) !== false;
    });


        




        return view('Livewire.permission.edit', compact('departments', 'companies', 'roles'));
    }
}
