<?php

namespace App\Http\Livewire\Salaries;

use App\Models\SalaryDeposit;
use App\Models\Signature;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class DepositSalary extends Component
{
    public $idSalary, $username,$userbank ,$date , $salary,$company ,$accountNo ,$amount_written,$month,$signatures,$err;
    public $addManager,$signaturesName,$addseg,$image;
    protected  $rules = [
        'company' => 'required|string',
        'userbank' => 'required|string',
        'accountNo' => 'required|numeric',
        'amount_written' => 'required|string',
        'signatures' => 'required|array',
        'month' => 'required|date',
    ];
    public function mount(string $id,$salary, $id_salary){
        $this->signaturesName = Signature::latest()->get();
        $this->salary = $salary;
        $this->idSalary = $id_salary;
        $this->date = new DateTime();
        $this->date=$this->date->format('Y-m-d');
        $user = User::where("id",$id)->select("name","iban","bank","company_id")->first();
        $this->company = $user->company->name;
        if($this->company == 'Lyon Travel'){
            $this->image='lyontravell.png';
        }
        elseif($this->company == 'Lyon Rental Car'){
            $this->image='lyonrentall.png';
        }
        else{
            $this->image='marvellLogo.png';
        }
        dd(dirname(__DIR__,3) );
        $this->username = $user->name;
        $this->userbank = $user->bank;
    }
    public function render(){
        return view('livewire.salaries.deposit-salary',["signaturesName"=>$this->signaturesName, "company"=>$this->company,"username"=>$this->username,"userbank"=>$this->userbank,"date"=>$this->date,"salary"=>$this->salary]);
    }
    public function save(){
        $this->validate();
        $this->month = $this->month."-01";
        $this->signatures = implode(',',$this->signatures);
        // check if salary deposi exisit or not
        $check = SalaryDeposit::where("salary_id",$this->idSalary)->where("month",$this->month)->first();
        if($check)return $this->err="there are salary for this month";
        $data = new SalaryDeposit();
        $data->salary_id  = $this->idSalary;
        $data->deposit_by  = auth()->id();
        $data->name  =  $this->username;
        $data->salary  = $this->salary;
        $data->date  = $this->date;
        $data->bank  = $this->userbank;
        $data->company  = $this->company;
        $data->month  = $this->month;
        $data->account_number  = $this->accountNo;
        $data->amount_written  = $this->amount_written;
        $data->signatures  =json_encode($this->signatures);
        $data = $data->save();
        return redirect()->route("payroll.slips");
    }
    public function addsignatures(){
        $data = new Signature();
        $data->signature = $this->addseg;
        $data->save();
        return redirect()->route("payroll.slips");
    }
}