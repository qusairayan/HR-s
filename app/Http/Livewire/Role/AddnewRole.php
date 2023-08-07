<?php

namespace App\Http\Livewire\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\Company;
use App\Models\Permission;
use Livewire\Component;


class AddnewRole extends Component
{
    public $role;
    public $showSavedAlert = false;
    public $showDemoNotification = false;
    public $arrows;
    public $name = '';
    public $permissions;
    public $rolePermissions = [];
    public $permissionSearch = '';
    public $rolePermissionSearch = '';

    protected $rules = [
        'name' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add()
    {
        $this->validate([
            'name' => 'required',
        ]);

        return redirect('/roles');
    }

    public function addPermission($name)
    {
        array_push($this->rolePermissions,$name);
        $this->arrows = '<div class="mid-arrow">
        <span></span>
        <span></span>
        <span></span>
    </div>
    ';    }

    public function removePermission($name)
    {

   
        $this->rolePermissions = array_diff($this->rolePermissions,[$name]);
        
    
    }

    public function render()
    {
        $this->permissions=Permission::all();

               $this->permissions = collect($this->permissions);

               $this->permissions = $this->permissions->diff($this->rolePermissions)->filter(function ($permission) {
                return strpos($permission->description, $this->permissionSearch) !== false;
            });
       
              
            return view('Livewire.role.addNewRole');
    }
}
