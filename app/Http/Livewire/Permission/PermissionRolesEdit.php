<?php

namespace App\Http\Livewire\Permission;




use App\Models\Department;
use App\Models\Company;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Livewire\Component;





class PermissionRolesEdit extends Component
{

    public $role;


    public $showSavedAlert = false;
    public $showDemoNotification = false;



    public $name;
    public $roleAllPermissions;


    public $allPermissions;

    public $arrows='';

    public $rolePermissionSearch='';
    public $permissionSearch='';

    public function mount(Role $role)
    {


        $this->role = $role;
        $this->name = $role->name;

    }



 


public function addPermission($name){

    $this->role->givePermissionTo($name);
    $this->arrows = '<div class="mid-arrow">
    <span></span>
    <span></span>
    <span></span>
</div>
';


}

public function removePermission($name){

    $this->role->revokePermissionTo($name);



}


    public function render()
    {



        $roles = Role::all();





        $this->roleAllPermissions = $this->role->permissions;





        $this->allPermissions = Permission::all();


       $this->allPermissions = $this->allPermissions->diff($this->roleAllPermissions)->filter(function ($permission) {
        return strpos($permission->description, $this->permissionSearch) !== false;
    });
    $this->roleAllPermissions= $this->roleAllPermissions ->filter(function ($permission) {
        return strpos($permission->description, $this->rolePermissionSearch) !== false;
    });


        




        return view('livewire.permission.roleEdit', compact( 'roles'));
    }
}
