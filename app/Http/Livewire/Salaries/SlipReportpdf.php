<?php

namespace App\Http\Livewire\Salaries;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\PartTime;
use App\Models\User;
use Mpdf\Mpdf;

class SlipReportpdf extends Component
{
    public function generatePDF($id, $date, )
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

        $checks = DB::connection('LYONDB')->table($checkComp)->where('Name_To','LIKE',$employee)->whereBetween('Date',[$from,$to])->get();

        if ($date) {
            $partTimeQuery = $partTimeQuery->where('from', '>=', $date);
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
        $mpdf->WriteHTML(view('livewire.salaries.SlipReport', ['partTime' => $partTime,'checks' => $checks,'employee' => $employee,'employee_id' => $employee_id,'company' => $company,'image' => $image,'department' => $department,'position' => $position,'from'=>$from,'to'=>$to]));

        $mpdf->Output('document.pdf', 'I');
    }

    public function render()
    {
        return view('livewire.salaries.partTimeReport');
    }
}




