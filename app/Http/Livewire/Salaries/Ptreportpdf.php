<?php

namespace App\Http\Livewire\Salaries;

use App\Models\Allownce;
use App\Models\Deductions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\PartTime;
use App\Models\User;
use Mpdf\Mpdf;
use stdClass;

class Ptreportpdf extends Component
{
    public $user ;
    private $partTime;
    private $checks;
    private $dedction;
    private $allownce;
    public $checkComp;
    public $image;
    public $reBalance;
    public function generatePDF($id, $from, $to)
    {
        $from = $from."-01";
        $to = $to."-31";
        $this->getDate($id,$from,$to);
       $this->reBalance = $this->reBalance($from, $to);
        // $user=User::where('id','=',$id)->first();
        // $employee=$user->name;
        // $position=$user->position;
        // $employee_id=$user->id;
        // $company=$user->company->name;
        // $department=$user->department->name;
        // $partTimeQuery = PartTime::where('user_id', '=', $id);

        // $checkComp='';
        // $image='';
        // if($company == 'Lyon Travel'){
        //     $checkComp='check_lyon';
        //     $image='lyontravell.png';
        // }
        // elseif($company == 'Lyon Rental Car'){
        //     $checkComp='check_lyon_rental';
        //     $image='lyonrentall.png';
        // }
        // else{
        //     $checkComp='check_marvell';
        //     $image='marvellLogo.png';
        // }

        // $checks = DB::connection('LYONDB')->table($checkComp)->where('Name_To','LIKE',$employee)->whereBetween('Date',[$from,$to])->orderBy("date")->get()->toArray();
        
        // if ($from) {
        //     $partTimeQuery = $partTimeQuery->where('from', '>=', $from);
        // }
        // if ($to) {
        //     $partTimeQuery = $partTimeQuery->where('to', '<=', $to);
        // }
        // $partTime = $partTimeQuery->get();
        // $dedction = Deductions::where("user_id",$id)->orderBy("date")->get()->toArray();
        // $allownce = Allownce::where("user_id",$id)->orderBy("date")->get()->toArray();
        $checks = [];
        if($this->checks){
            for($i=0;$i<count($this->checks);$i++){
                $checks[$i] = (array) $this->checks[0];
            }
        }
        $information = [];
        $count = count($this->checks) +count($this->allownce) +count($this->dedction);
        if($this->dedction){
            foreach($this->dedction as $item){
                $count--;
                $information[$count]['transaction']    = "dedction";
                $information[$count]['date']    = $item["date"];
                $information[$count]['type']    = $item["type"];
                $information[$count]['amount']  = $item["amount"];
                $information[$count]['detail' ] = $item["detail"];
            }
        }
        if($this->allownce){
            foreach($this->allownce as $item){
                $count--;
                $information[$count]['transaction']    ="allownce";
                $information[$count]['date']    = $item["date"];
                $information[$count]['type']    = $item["type"];
                $information[$count]['amount']  = $item["amount"];
                $information[$count]['detail' ] = $item["detail"];
            }
        }
        if($checks){
            foreach($checks as $item){
                dd($item["Date"]);
                $count--;
                $information[$count]['transaction']    ="checks";
                $information[$count]['date']    = $item["Date"];
                $information[$count]['type']    = $item["Payment_Method"];
                $information[$count]['amount']  = $item["Value"];
                $information[$count]['detail' ] = $item["check_details"];
            }
        }
// sort    
    usort($information,function($a,$b){
        $dateA = strtotime($a["date"]);
        $dateB = strtotime($b["date"]);
        if ($dateA == $dateB) {
            return 0;
        }
        return ($dateA < $dateB) ? -1 : 1;
    });
    usort($this->partTime,function($a,$b){
        $dateA = strtotime($a["from"]);
        $dateB = strtotime($b["from"]);
        if ($dateA == $dateB) {
            return 0;
        }
        return ($dateA < $dateB) ? -1 : 1;
    });
    // sort
    $data =[];
    foreach ($this->partTime as $part) { 
        array_push($data ,$part);
        foreach ($information as $info) {
            $date1 = substr($part["from"],0,7);
            $date2 = substr($info["date"],0,7);
            if($date1 == $date2){
                array_push($data[count($data)-1] ,$info);
            }
        }
    }
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 10, 
            'margin_right' => 10, 
            'margin_top' => 10, 
            'margin_bottom' => 10, 
        ]);
        $mpdf->WriteHTML(view('livewire.salaries.partTimeReport', ["data"=>$data, "reBalance" =>$this->reBalance,"user"=>$this->user,'partTime'=>$this->partTime,'information' => $information,'from'=>$from,'to'=>$to]));
        $mpdf->Output('document.pdf', 'I');
    }
    private function reBalance($from,$to){
        $sum = PartTime::where('user_id', $this->user['id'])->where('from',"<",$from)->sum("amount");
        $sum += Allownce::where("user_id",$this->user['id'])->where('Date',"<",$from)->sum("amount");
        $sum -= Deductions::where("user_id",$this->user['id'])->where('Date',"<",$from)->sum("amount");
        $sum += DB::connection('LYONDB')->table($this->checkComp)->where('Name_To','LIKE',$this->user["name"])->where('Date',"<",$from)->sum("Value");
        return $sum;
    }
    private function getDate($id,$from,$to){
        $this->user=User::where('id',$id)->first();
        $this->user->company;
        $this->user->department->name;
        $this->user = $this->user->toArray();
        $this->user["company"] = $this->user["company"]["name"];
        $this->user["department"] = $this->user["department"]["name"];
        if($this->user["company"] == 'Lyon Travel'){
            $this->checkComp='check_lyon';
            $this->image='lyontravell.png';
        }
        elseif($this->user["company"] == 'Lyon Rental Car'){
            $this->checkComp='check_lyon_rental';
            $this->image='lyonrentall.png';
        }
        else{
            $this->checkComp='check_marvell';
            $this->image='marvellLogo.png';
        }
        // get parttime
        $this->partTime = PartTime::where('user_id', $this->user['id'])->where('from',">=",$from)->where("to","<=",$to)->get()->toArray();
        $this->checks = DB::connection('LYONDB')->table($this->checkComp)->where('Name_To','LIKE',$this->user["name"])->whereBetween('Date',[$from,$to])->orderBy("date")->get()->toArray();
        $this->dedction = Deductions::where("user_id",$this->user['id'])->whereBetween('Date',[$from,$to])->orderBy("date")->get()->toArray();
        $this->allownce = Allownce::where("user_id",$this->user['id'])->whereBetween('Date',[$from,$to])->orderBy("date")->get()->toArray();
    }
}




