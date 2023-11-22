<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Vacation;
use Livewire\Component;
use Mpdf\Mpdf;

class VacationPdf extends Component
{
    public $user ="" ;
    public function mount($id){
        $this->user = User::find($id);
        $this->user->department = $this->user->department->name;
        $this->user->company = $this->user->company->name;
    }
    public function render(){

        $id =$this->user->id;
        $vacations = Vacation::where("user_id",$id)->orderBy("date",'DESC')->get();
        $mpdf = new Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4-L',
        'margin_left' => 10, 
        'margin_right' => 10, 
        'margin_top' => 10, 
        'margin_bottom' => 10, 
    ]);
    $mpdf->WriteHTML(view('livewire.vacation-pdf', ["vacations"=>$vacations,"user"=>$this->user]));
    $mpdf->Output('document.pdf', 'I');
    }
}
