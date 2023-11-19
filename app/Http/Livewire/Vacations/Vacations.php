<?php
namespace App\Http\Livewire\Vacations;

use App\Models\User;
use App\Models\Vacation;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithPagination;

class Vacations extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $paginationView = 'vendor.pagination.custom';

    public function render()
    {
        $vacations = Vacation::leftJoin('users', 'vacations.user_id', '=', 'users.id')
            ->leftJoin('department', 'users.department_id', '=', 'department.id')
            ->select('vacations.*', 'users.name as user_name', 'department.name as department_name')
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.vacations.vacations', compact('vacations'));
    }

    public function approve(Vacation $vacations,$vacation,$type,$user_id)
    {
        $user = User::find($user_id);
        $vacation = Vacation::find($vacation);
        if($vacation->status == 1)return redirect()->route('vacations');
        if($user->type == 0){
            if($user->sick_vacation >= $vacation->period)$user->sick_vacation- $vacation->period ;
            else return redirect()->route('vacations')->with(["err"=>"You do not have a balance of sick leave"]);
        }
        else {
            if($user->annual_vacation >= $vacation->period)$user->annual_vacation- $vacation->period ;
            else return redirect()->route('vacations')->with(["err"=>"You do not have a balance of annual leave"]);
        }
        $user->save();
        $vacation->status = 1;
        $vacation->save();
        return redirect()->route('vacations');
    }

    public function reject ($vacation)
    {
        $vacation = Vacation::find($vacation);
        $vacation->status = 2;
        $vacation->save();
        return redirect()->route('vacations');
    }
}
