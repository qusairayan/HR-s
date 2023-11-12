<?php

namespace App\Http\Livewire\Employees;

use App\Models\PublicBank;
use Livewire\Component;

class Banks extends Component
{
    public string $bankName;
    protected $rules =[
        "bankName"=>"required|string|min:3|max:50|unique:public_banks",
    ];
    public function render(){
        $banks =PublicBank::latest()->paginate(10);
        return view('livewire.employees.banks',["banks"=>$banks]);
    }
    public function create(){
        $this->validate();
        PublicBank::create(["bankName"=>$this->bankName]);
    }
    public function update($id){
        $this->validate();
        PublicBank::where("id",$id)->update(["bankName"=>$this->bankName]);
    }
    public function delete($id){
        PublicBank::where("id",$id)->delete();
    }
}
