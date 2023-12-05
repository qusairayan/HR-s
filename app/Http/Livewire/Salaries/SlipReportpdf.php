<?php
namespace App\Http\Livewire\Salaries;
use App\Models\Allownce;
use App\Models\deduction_allowances_types;
use App\Models\Deductions;
use App\Models\MonthlyPayroll;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\PartTime;
use App\Models\Promotion;
use App\Models\Salary;
use App\Models\SocialSecurity;
use App\Models\User;
use DateTime;
use Mpdf\Mpdf;
use PhpParser\Node\Stmt\Return_;
class SlipReportpdf extends Component{
    public $user;
    public function generatePDF($id, $date){
        $this->getUser($id,$date);
        $deduction = Deductions::leftJoin("deduction_allowances_types","deductions.type","deduction_allowances_types.id")
        ->where("date","LIKE",$date."-%")->where("user_id",$id)
        ->get()->toArray();
        $names = array_column($deduction,"name");
        $deductionTypes = deduction_allowances_types::where("type",0)->whereNotIn("name", $names)->get()->toArray();
        $allownce = Allownce::leftJoin("deduction_allowances_types","allownces.type","deduction_allowances_types.id")->where("date","LIKE",$date."-%")->where("user_id",$id)->get()->toArray();
        $names = array_column($allownce,"name");
        $allownceTypes = deduction_allowances_types::where("type",1)->whereNotIn("name", $names)->get()->toArray();
        $checks = DB::connection('LYONDB')
        ->table($this->user["checkComp"])
        ->where('NAME_TO', $this->user["name"])
        ->where("date","LIKE",$date."-%")
        ->select("Payment_Method","Value","Date","check_details")
        ->get()->toArray();
        $currentDate = date("Y-m");
$dateTime = new DateTime($currentDate);
$dateTime->modify("-1 month");
$newDate = $dateTime->format("Y-m");
        $monthly_payroll = MonthlyPayroll::where("month","LIKE",$newDate."-%")->where("user_id",$this->user["id"])->pluck("salary")->first();
        $promotion = Promotion::where("user_id",$this->user["id"])->where('from', '<=', $date."-01")->where(function ($query) use ($date){
            $query->where('to', '>=', $date."-01")->orWhereNull("to");
        })->pluck("salary")->first();
        // if($promotion)if($promotion)$this->user["salary"] = $promotion;
        $this->user["salary"] = $monthly_payroll ?? $promotion ?? $this->user["salary"];
        dd($this->user["salary"] );
        $social = SocialSecurity::where("date","Like",date("Y-m")."-%")->where("user_id",$id)->first();
        if($social) $social = $this->user["salary"] * 0.075;
        $this->runPdf('livewire.salaries.SlipReport',["social"=>$social, "user"=>$this->user,"allownce"=>$allownce,"deduction"=>$deduction,'checks' => $checks,'date'=>$date,"deductionTypes"=>$deductionTypes,"allownceTypes"=>$allownceTypes]);
    }
    public function FullTimegeneratePDF($id, $from ,$to){
        $this->getUser($id);
        $check= $this->getChecks($from."-01",$to."-01");
        $preBalance = $this->PreBalance($from."-30");
        $salaries = $this->calcSalary($from."-01",$to."-01");
        $arr = array_merge($salaries,$check);
        $months = array_column($arr, 'month');
        array_multisort($months, SORT_ASC, $arr);
        $this->runPdf('livewire.salaries.full-time-report',["user"=>$this->user,"arr"=>$arr,"preBalance"=>$preBalance,'from'=>$from ,"to"=>$to]);
    }
    private function runPdf(string $view , array $arr):void{
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            // 'format' => 'A6-L',
            'format' => [280, 436],
            'margin_left' => 10, 
            'margin_right' => 10, 
            'margin_top' => 10, 
            'margin_bottom' => 10, 
        ]);
        $mpdf->WriteHTML(view($view,$arr));
        $mpdf->showImageErrors = true;
        $mpdf->Output('document.pdf', 'I');
        exit;
    }
    private function getUser($id, $date =null){
        $this->user = User::where("id",$id)->first();
        $this->user->company;
        $this->user->department->name;
        $this->user = $this->user->toArray();
        $this->user["company"] = $this->user["company"]["name"];
        $this->user["department"] = $this->user["department"]["name"];
        if(!$date){
            $promotion = Promotion::where("user_id",$this->user["id"])->orderBy("from","desc")->pluck("salary")->first();
            if($promotion)$this->user["salary"] = $promotion;
            if($promotion)$this->user["salary"] = $promotion;
        } 
        return $this->IdentifyCompany();
    }
    private function IdentifyCompany(){
        switch ($this->user['company']){
            case 'Lyon Travel':
                $this->user['checkComp']='check_lyon';
                $this->user['image']='lyontravell.png';
            break;
            case 'Lyon Rental Car':
                $this->user['checkComp']='check_lyon';
                $this->user['image']='lyontravell.png';
            break;
            default:
                $this->user['checkComp']='check_marvell';
                $this->user['image']='marvellLogo.png';
            break;
        }
        return $this->getSocialSecurity();
    }
    private function getSocialSecurity(){
        try {
            $test= SocialSecurity::where("user_id",$this->user["id"])->first();
            $this->user["SocialSecurity"] = $test->onEmployee;
            
        } catch (\Throwable $th) {
            $this->user["SocialSecurity"] = 0;
        }
    }
    private function getChecks(string $from,$to =NULL){

        if(!$to){
        $checks = DB::connection('LYONDB')
        ->table($this->user["checkComp"])
        ->where('NAME_TO', $this->user["name"])
        ->orWhere('NAME_TO', 'like', '%' . $this->user["name"] . '%')
        ->whereBetween("date",[$from,$to])
        ->orderBy("date")
        ->select("Payment_Method","Value","Date","check_details")
        ->get()->toArray();
        }
        else{
  
        $from = substr($from,0,7 );
        $from = $from."-30";
        $checks = DB::connection('LYONDB')
        ->table($this->user["checkComp"])
        ->where("Date",">=",$from)
        ->where('NAME_TO', $this->user["name"])
        ->orWhere('NAME_TO', 'like',"%-".$this->user["name"].'-%')->select("*","Date as month")
        ->get()->toArray();
    }
        return $checks;
    }
    private function getDeductions(string $from,$to = NULL){
        if(!$to)return Deductions::where('user_id',$this->user['id'])->where("date", ">=", $from)->orderBy("date")->get()->toArray();
        return Deductions::where('user_id',$this->user['id'])->whereBetween("date",[$from,$to])->get()->toArray();
    }
    private function getAllownce(string $from,$to = NULL){
        if(!$to)return Allownce::where('user_id',$this->user['id'])->where("date", ">=", $from)->orderBy("date")->get()->toArray();
        return Allownce::where('user_id','=',$this->user['id'])->whereBetween("date",[$from,$to])->get()->toArray();
    }
    private function PreBalance($from){
        $sum = DB::connection('LYONDB')
        ->table($this->user["checkComp"])
        ->where("Date","<=",$from)
        ->where('NAME_TO', $this->user["name"])
        ->orWhere('NAME_TO', 'like',"%-".$this->user["name"].'-%')
        ->whereBetween('Date',[$this->user["start_date"],$from])->sum("Value");
        $sum -= MonthlyPayroll::where("user_id",$this->user["id"])->whereBetween("month",[$this->user["start_date"],$from])->sum("salary");
        return $sum;
    }
    private function calcSalary($from,$to){
        $salaries = MonthlyPayroll::where("user_id",$this->user["id"])->whereBetween("month",[$from,$to])->select("salary","month")->orderBy("month","asc")->get()->toArray();
        return $salaries;
    }
}