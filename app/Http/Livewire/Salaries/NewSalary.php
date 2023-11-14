<?php
namespace App\Http\Livewire\Salaries;

use App\Models\Allownce;
use App\Models\Company;
use App\Models\Deductions;
use App\Models\Department;
use App\Models\MonthlyPayroll;
use App\Models\Promotion;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
class NewSalary extends Component{
    public $user , $date ,$userSalary=0,$userDeduction=0,$userAllownces=0,$netSalary=0,$err="",$monthlyPayrollId;
    public function render(){
        $this->monthlyPayrollId = MonthlyPayroll::orderBy("id","desc")->pluck("id")->first();
        $users = User::where("part_time",'')->orWhere("part_time",NULL)->get();
        return view('livewire.salaries.new-salary',["monthlyPayrollId"=>$this->monthlyPayrollId,"users"=>$users,"userSalary"=>$this->userSalary,"userDeduction"=>$this->userDeduction,"userAllownces"=>$this->userAllownces,"netSalary"=>$this->netSalary]);
    }
    public function add(){
        $this->userSalary = Promotion::where("user_id",$this->user)->where("from","<=",$this->date."-01")->orderBy("from","desc")->pluck("salary")->first();
        $this->userDeduction = Deductions::where("user_id",$this->user)->where("date","LIKE",$this->date . '-%')->sum("amount");
        $this->userAllownces = Allownce::where("user_id",$this->user)->where("date","LIKE",$this->date . '-%')->sum("amount");
        $user = User::where("id",$this->user)->select("salary","start_date","unemployment_date")->get()->toArray();
        $unemployment = Carbon::parse( $user[0]["unemployment_date"]) ?? NULL;
        $startDate = Carbon::parse( $user[0]["start_date"]);
        if(!$this->userSalary){
            $this->userSalary = $user[0]["salary"];
        }          
        if($unemployment && $unemployment->format("Y-m") === $this->date){
            $countDays = (int) $unemployment->format("d");
            $salaryPerDay = $this->userSalary /30;
            $this->userSalary = $salaryPerDay * $countDays;
            $this->userSalary =number_format($this->userSalary,2,"."," ");
        }elseif($startDate->format("Y-m") === $this->date ){
            $countDays = 31 - $startDate->format("d");
            $salaryPerDay = $this->userSalary /30;
            $this->userSalary = $salaryPerDay * $countDays;
            $this->userSalary =number_format($this->userSalary,2,"."," ");
        }
        $this->netSalary = $this->userSalary - $this->userDeduction + $this->userAllownces;
    }
    public function approve(){
        $monthlyPayroll = MonthlyPayroll::where("user_id",$this->user)->where("month","LIKE",$this->date."-%")->first();
        
        if($monthlyPayroll)return $this->err="The employee actually has a salary this month";
        $data =new MonthlyPayroll();
        $data->user_id=$this->user;
        $data->salary=$this->netSalary;
        $data->month=$this->date."-01";
        $data =$data->save();
        return $this->err="The employee's salary for this month has been successfully added";
    }
}
