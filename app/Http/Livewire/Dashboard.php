<?php

namespace App\Http\Livewire;

use App\Models\Attendence;
use App\Models\User;
use DateInterval;
use DateTime;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(){
        $users = User::join("company","users.company_id","company.id")
        ->leftJoin("attendence",function($join){
            $join->on("users.id","attendence.user_id")
            ->where("date",date("Y-m-d"));
        })->leftJoin("employees_contracts",function($join){
            $join->on("users.id","employees_contracts.user_id");
        })
        ->whereNotNull("attendence.check_in")->where("users.status",1)->orderBy("id","DESC")->select("users.*","company.name as company","attendence.check_in","employees_contracts.date as contract")->get();
       
        $users= $users->map(function($user){
            $time = new DateTime();
            if($user->contract)$user->expire_contract =  date("Y-m-d", strtotime(date("Y-m-d", strtotime($user->contract)) . " + 1 year"));
            return $user;
        });
        return view('dashboard',compact("users"));
    }
}
