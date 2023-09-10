<?php

namespace App\Http\Livewire\Employees;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Company;
use App\Models\Department;

use Livewire\Component;
use Livewire\WithPagination;

class PromotionEdit extends Component
{
    use WithPagination;


    public $search = '';
    public $company = '';
    public $department = '';
    public $user = '';
    public $user_id = '';



  
    public function render(Promotion $promotion)
    {        $user_name=User::find($promotion->id)->name;

        $promotion->user_naem=$user_name;
        return view('livewire.employees.editpromotion', ['promotion' => $promotion]);
    
    
    
    }




}
