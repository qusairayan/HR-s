<?php

namespace App\Http\Livewire\Permission;

use App\Models\User;
use App\Models\Department;
use App\Models\Schedules;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    use WithPagination;

    public $search = '';


    public $user;





    public function render()
    {

        $users = User::leftJoin('department', 'users.department_id', '=', 'department.id')
        ->select('users.*', 'department.name as department_name')->with('roles', 'permissions')->get();


        return view('livewire.permission.permissions',compact('users'));
    }

public function getRandomColor() {
    $red = rand(0, 160);
    $green = rand(0, 150);
    $blue = rand(0, 200);

    $colorCode = sprintf("#%02x%02x%02x", $red, $green, $blue);

    return $colorCode;
}

}

