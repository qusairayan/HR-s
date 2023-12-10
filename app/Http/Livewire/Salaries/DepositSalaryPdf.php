<?php
namespace App\Http\Livewire\Salaries;

use App\Models\MonthlyPayroll;
use App\Models\SalaryDeposit;
use App\Models\Signature;
use App\Models\User;
use DateTime;
use Livewire\Component;
use Mpdf\Mpdf;

class DepositSalaryPdf extends Component
{
    public $salaryDeposit , $signature;
    public function mount(string $id){
        $this->salaryDeposit = SalaryDeposit::where("id",$id)->first()->toArray();
        $id = MonthlyPayroll::where("id",$this->salaryDeposit["salary_id"])->select("user_id")->first()->toArray();
        $this->salaryDeposit["iban"] = User::where("id",$id["user_id"])->select("iban")->first()->toArray()["iban"];
        $this->salaryDeposit["month"] = substr($this->salaryDeposit["month"],0,7);
        $ids = json_decode($this->salaryDeposit["signatures"]);
        $ids = explode(",",$ids) ;
        $ids = array_values($ids);
        $this->signature = Signature::whereIn('id', $ids)->get()->toArray();
    }
    public function render()
    {
        $date  = date("Y/m/d");
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 10, 
            'margin_right' => 10, 
            'margin_top' => 10, 
            'margin_bottom' => 10, 
        ]);
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML(view('livewire.salaries.deposit-salary-pdf', ["date"=>$date,"data"=>$this->salaryDeposit,"signature"=>$this->signature]));
        $mpdf->showImageErrors = true;
        $mpdf->Output('document.pdf', 'I');
        exit;
    }
}