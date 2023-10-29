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
    public function generatePDF($id, $from, $to)
    {

        $user=User::where('id','=',$id)->first();
        $employee=$user->name;
        $position=$user->position;
        $employee_id=$user->id;
        $company=$user->company->name;
        $department=$user->department->name;

        $partTimeQuery = PartTime::where('user_id', '=', $id);

        $checkComp='';
        $image='';

        if($company == 'Lyon Travel'){
            $checkComp='check_lyon';
            $image='lyontravell.png';
        }
        elseif($company == 'Lyon Rental Car'){
            $checkComp='check_lyon_rental';
            $image='lyonrentall.png';
        }
        else{
            $checkComp='check_marvell';
            $image='marvellLogo.png';
        }

        $checks = DB::connection('LYONDB')->table($checkComp)->where('Name_To','LIKE',$employee)->whereBetween('Date',[$from,$to])->orderBy("date")->get()->toArray();

        if ($from) {
            $partTimeQuery = $partTimeQuery->where('from', '>=', $from);
        }
        if ($to) {
            $partTimeQuery = $partTimeQuery->where('to', '<=', $to);
        }


        $partTime = $partTimeQuery->get();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 10, 
            'margin_right' => 10, 
            'margin_top' => 10, 
            'margin_bottom' => 10, 
        ]);
        $dedction = Deductions::where("user_id",$id)->orderBy("date")->get()->toArray();
        $allownce = Allownce::where("user_id",$id)->orderBy("date")->get()->toArray();


        $information = [];
        $count = count($checks) +count($allownce) +count($dedction);
        if($dedction){
            foreach($dedction as $item){
                $count--;
                $information[$count]['transaction']    = "dedction";
                $information[$count]['date']    = $item["date"];
                $information[$count]['type']    = $item["type"];
                $information[$count]['amount']  = $item["amount"];
                $information[$count]['detail' ] = $item["detail"];
            }
        }
        if($allownce){
            foreach($allownce as $item){
                $count--;
                $information[$count]['transaction']    ="allownce";
                $information[$count]['date']    = $item["date"];
                $information[$count]['type']    = $item["type"];
                $information[$count]['amount']  = $item["amount"];
                $information[$count]['detail' ] = $item["detail"];
            }
        }
        $checks[0] = (array) $checks[0];
        if($checks){
            foreach($checks as $item){
                $count--;
                $information[$count]['transaction']    ="checks";
                $information[$count]['date']    = $item["Date"];
                $information[$count]['type']    = $item["Payment_Method"];
                $information[$count]['amount']  = $item["Value"];
                $information[$count]['detail' ] = $item["check_details"];
            }
        }
        usort($information,function($a,$b){
            $dateA = strtotime($a["date"]);
            $dateB = strtotime($b["date"]);
            if ($dateA == $dateB) {
                return 0;
            }
            return ($dateA < $dateB) ? -1 : 1;
        });
        // dd($information);
        // $mpdf->WriteHTML(view('livewire.salaries.partTimeReport', ['partTime' => $partTime,'checks' => $checks,'employee' => $employee,'employee_id' => $employee_id,'company' => $company,'image' => $image,'department' => $department,'position' => $position,'from'=>$from,'to'=>$to,"dedction"=>$dedction,"allownce"=>$allownce]));
        $mpdf->WriteHTML(view('livewire.salaries.partTimeReport', ['partTime' => $partTime,'information' => $information,'employee' => $employee,'employee_id' => $employee_id,'company' => $company,'image' => $image,'department' => $department,'position' => $position,'from'=>$from,'to'=>$to]));

        $mpdf->Output('document.pdf', 'I');
    }

    public function render()
    {
        return view('livewire.salaries.partTimeReport');
    }
}




