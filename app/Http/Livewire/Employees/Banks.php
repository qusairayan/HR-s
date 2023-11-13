<?php

namespace App\Http\Livewire\Employees;

use App\Models\Bank;
use Livewire\Component;

class Banks extends Component
{
    public string $bankName;
    protected $rules =[
        "bankName"=>"required|string|min:3|max:50|unique:public_banks",
    ];
    public function render(){
        $banks =Bank::latest()->paginate(10);
        return view('livewire.employees.banks',["banks"=>$banks]);
    }
    public function create(){
        $this->validate();
        Bank::create(["name"=>$this->bankName]);
    }
}
