<?php



namespace App\Http\Livewire\Salaries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Salary;
use App\Models\Promotion;
use App\Models\Company;
use App\Models\PartTime;

use App\Models\User;
use Livewire\WithPagination;
use Carbon\Carbon;

use Livewire\Component;


class ViewPartTimes extends Component
{

    public $showSavedAlert = false;
    public $showDemoNotification = false;


    public $parttime;



    public $company = '';
    public $employee = '';
    public $employee_id = '';



    public $from = '';
    public $to = '';


    public $salary = 0;
    public $total = 0.0;



    public $part_search = '';
    public $noSalary = false;
    public $period = '';
    public $dateSet = false;
    public $date_incorrect = false;



    public function mount(PartTime $parttime)
    {
        $this->parttime = $parttime;
        $user = User::where('id', '=', $parttime->user_id)->first();

        $this->employee = $user->name;
        $this->employee_id = $user->id;
        $this->total = $parttime->amount;
        $this->from = $parttime->from;
        $this->to = $parttime->to;
    }
   



    public function render()
    {

        

        return view('livewire.salaries.viewPartTime');
    }
}
