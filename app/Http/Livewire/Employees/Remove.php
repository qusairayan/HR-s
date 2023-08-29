<?php

namespace App\Http\Livewire\Employees;
use Illuminate\Http\Request;
use App\Models\User;
use Livewire\Component;

class Remove extends Component
{
    public $user;

    public function mount(Request $request)
    {
        $id= $request->input('id');
        $user = User::where('id',$id);
        return view('livewire.employees.edit', compact('user'));
    }





}

