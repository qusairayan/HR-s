<?php

namespace App\Http\Livewire\Permission;




use App\Models\Department;
use App\Models\Company;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Livewire\Component;





class PermissionRoles extends Component
{

    public $role;



    public function render()
    {


       
        $roles = Role::all();
        return view('Livewire.permission.roles', compact('roles'));
    }

    
public function getRandomColor() {
    $red = rand(0, 160);
    $green = rand(0, 150);
    $blue = rand(0, 200);

    $colorCode = sprintf("#%02x%02x%02x", $red, $green, $blue);

    return $colorCode;
}

}
