<?php
namespace App\Http\Livewire\Vacations;

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

    public function approve(Vacation $vacations)
    {
        $vacations->status = 1;
        $vacations->save();

        return redirect()->route('vacations');
    }

    public function reject (Vacation $vacations)
    {
        $vacations->status = 2;
        $vacations->save();


        return redirect()->route('vacations');
    }
}
