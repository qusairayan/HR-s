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

class EditPartTimes extends Component
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
        $user = User::find($parttime->user_id);
        $this->employee = $user->name;
        $this->employee_id = $user->id;
        $this->total = $parttime->amount;
        $this->from = $parttime->from;
        $this->to = $parttime->to;
        $this->period = $user->part_time;
        $this->salary = $user->salary;
    }
    public function updated()
    {
        $this->validate([
            'from' => 'required|date',
            'to' => 'required|date',
        ]);
        // Assuming you have two date values as Carbon objects
        if ($this->from && $this->to) {
            $this->dateSet = false;
            $from = Carbon::parse($this->from);
            $to = Carbon::parse($this->to);
            if ($to < $from) {
                $this->date_incorrect = true;
                return false;
            } else {
                $this->date_incorrect = false;
            }
            $daysDifference = $from->diffInDays($to);
            $daysDifference = $from->diffInDays($to);
            $year = "20" . $from->format("y");
            $month = $from->format("m");
            $countOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            if ($this->period == 'daily') {
                if (($daysDifference + 1) == $countOfDays) $this->total = round($this->salary * 30, 1);
                else $this->total =  round($this->salary * ($daysDifference + 1), 1);
            } else if ($this->period == 'weekly') {
                $this->total =  round($this->salary / 7 * $daysDifference, 1);
            } else if ($this->period == 'monthly') {
                if (($daysDifference + 1) == $countOfDays) $this->total = $this->salary;
                else $this->total = round($this->salary / 30 * $daysDifference, 1);
            }
        }
    }
    public function add()
    {
        $this->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $check = PartTime::where('user_id', '=', $this->employee)
            ->where(function ($query) {
                $query->whereBetween('from', [$this->from, $this->to])
                    ->orWhereBetween('to', [$this->from, $this->to]);
            })
            ->first();
        if ($check) {
            $this->dateSet = true;
            return false;
        }
        $from = Carbon::parse($this->from);
        $to = Carbon::parse($this->to);
        if ($to < $from) {
            $this->date_incorrect = true;
            return false;
        }
        $this->parttime->update([
            'from' => $this->from,
            'to' => $this->to,
            'status' => 1,
            'amount' => $this->total,
        ]);
        $this->parttime->save();
        $this->showSavedAlert = true;
        redirect(route('payrolls.part_time'));
    }
    public function render()
    {
        return view('livewire.salaries.editPartTime');
    }
}
