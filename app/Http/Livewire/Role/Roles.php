<?php

namespace App\Http\Livewire\Role;

use App\Traits\RandomColorTrait;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination,RandomColorTrait;

    public $search = '';


    public $roles;
    public $roleName;





    public function render()
    {

        $this->roles = Role::all();

        return view('livewire.role.roles');
    }


public function addRole(){

    $this->validate(
        ['roleName' => 'required']
    );


    Role::create([
        'name' => $this->roleName,
    ]);
    return redirect(route('roles'));
}


public function removeRole($name){
    $role = Role::where('name', $name)->first();

    if ($role) {
        $role->delete();
    }
}


}

