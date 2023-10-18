<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{

    public $username = '';
    public $password = '';
    public $remember_me = false;

    protected $rules = [
        'username' => 'required|',
        'password' => 'required|min:6',
    ];

    //This mounts the default credentials for the admin. Remove this section if you want to make it public.
    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/dashboard');
        }
        $this->fill([
            'username' => 'qusai',
            'password' => 'test1234',
        ]);
    }

    public function login()
    {
        $credentials = $this->validate();
        if (auth()->attempt(['username' => $this->username, 'password' => $this->password], $this->remember_me)) {
            $user = User::where(['username' => $this->username])->first();
            auth()->login($user, $this->remember_me);
            return redirect()->intended('/dashboard');
        } else {
            return $this->addError('username', trans('auth.failed'));
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
