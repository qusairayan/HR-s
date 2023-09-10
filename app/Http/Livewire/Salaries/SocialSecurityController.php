<?php



namespace App\Http\Livewire\Salaries;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\SocialSecurity;
use App\Models\User;
use App\Models\Company;
use App\Models\Promotion;
use Livewire\WithPagination;

use Livewire\Component;


class SocialSecurityController extends Component
{
    use WithPagination;

    public $paginator = 10;
    public $search = '';
    public $company = '';
    public $department = '';
    public $user='';
    public $add=false;

    public function updated()
    {
        if ($this->user) {
           $userSS= SocialSecurity::where('User_id','=',$this->user)->first();

           if($userSS){
            $this->add=false;
           }
           else{
            $this->add=true;
            
        }
        }
    

    }

    public function addSocialSecurity()
    {




        $exist=SocialSecurity::where('user_id','=',$this->user)->first();


        if(!$exist){

            $currentMonth = date('Y-m-d');
            $socialsecurity=new SocialSecurity(['user_id'=>$this->user,
        'date'=>$currentMonth]);
        $socialsecurity->save();


        }
        
    }
    public function render()
    {

        $companies = Company::all();

        $departmentsQuery = Department::select('*');
        if($this->company){
            $departmentsQuery-> Where('company_id', '=', $this->company);
        }
        $departments=$departmentsQuery->get();



        $usersQuery = User::select('*');
        if($this->company){
            $usersQuery->Where('department_id', '=', $this->department);
        }
        $users=$usersQuery->get();





        $socialsecurityQuery = SocialSecurity::leftJoin('users', 'social_security.user_id', '=', 'users.id')
        ->leftJoin('department', 'users.department_id', '=', 'department.id')
        ->leftJoin('company', 'company.id', '=', 'users.company_id')
        ->select('social_security.*', 'users.name as user_name','users.salary','users.position', 'department.name as dep_name','company.name as comp_name');
        if($this->search){
        $socialsecurityQuery->where('users.name', 'LIKE','%'. $this->search.'%')
        ->orWhere('company.name', 'LIKE','%'. $this->search.'%')
        ->orWhere('department.name', 'LIKE','%'. $this->search.'%');}
        if ($this->company) {
            $socialsecurityQuery->where('users.company_id',$this->company );
        }
        if ($this->department) {
            $socialsecurityQuery->where('users.department_id',$this->department  ) ;
        }
        if ($this->user) {
            $socialsecurityQuery->where('users.id',$this->user  ) ;
        }
        $socialsecurity=$socialsecurityQuery->get();
    
foreach ($socialsecurity as $soc) {
    $promotion=Promotion::where('user_id','=',$soc->user_id)->orderBy('from','desc')->first();
    if ($promotion) {
        $soc->salary=$promotion->salary;
        $soc->position=$promotion->position;
    }
}
        return view('livewire.salaries.socialsecurity', ['socialsecurity'=>$socialsecurity,'users'=>$users,'departments'=>$departments,'companies'=>$companies]);
    }


    
}
