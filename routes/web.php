<?php

use App\Http\Livewire\BootstrapTables;
use App\Http\Livewire\Components\Buttons;
use App\Http\Livewire\Components\Forms;
use App\Http\Livewire\Components\Modals;
use App\Http\Livewire\Components\Notifications;
use App\Http\Livewire\Components\Typography;
use App\Http\Livewire\Dashboard;

use App\Http\Livewire\Employees\Employees;
use App\Http\Livewire\Employees\AddNewEmployee;
use App\Http\Livewire\Employees\Edit;
use App\Http\Livewire\Employees\Latenesses;
use App\Http\Livewire\Employees\Overtimes;
use App\Http\Livewire\Employees\Destroy;

use App\Http\Livewire\Leaves\Leaves;
use App\Http\Livewire\Vacations\Vacations;



use App\Http\Livewire\Attendence\Attendences;

use App\Http\Livewire\Schedule\Schedule;
use App\Http\Livewire\Schedule\SetSchedule;



use App\Http\Livewire\Deductions\DeductionsController;

use App\Http\Livewire\Allownces\AllowncesController;

use App\Http\Livewire\Salaries\Salaries;
use App\Http\Livewire\Salaries\AddSalaries;





use App\Http\Livewire\Permission\Permissions;
use App\Http\Livewire\Permission\PermissionEdit;
use App\Http\Livewire\Permission\PermissionRoles;
use App\Http\Livewire\Permission\PermissionRolesEdit;



use App\Http\Livewire\Role\Roles;
use App\Http\Livewire\Role\AddnewRole;





use App\Http\Livewire\Err404;
use App\Http\Livewire\Err500;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Lock;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\ForgotPasswordExample;
use App\Http\Livewire\Index;
use App\Http\Livewire\LoginExample;
use App\Http\Livewire\ProfileExample;
use App\Http\Livewire\RegisterExample;
use App\Http\Livewire\Transactions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ResetPasswordExample;
use App\Http\Livewire\UpgradeToPro;
use App\Http\Livewire\Users;
use App\Models\Leave;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Route::get('/register', Register::class)->name('register');

Route::get('/login', Login::class)->name('login');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::get('/404', Err404::class)->name('404');
Route::get('/500', Err500::class)->name('500');
Route::get('/upgrade-to-pro', UpgradeToPro::class)->name('upgrade-to-pro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile-example', ProfileExample::class)->name('profile-example');
    Route::get('/users', Users::class)->name('users');
    Route::get('/login-example', LoginExample::class)->name('login-example');
    Route::get('/register-example', RegisterExample::class)->name('register-example');
    Route::get('/forgot-password-example', ForgotPasswordExample::class)->name('forgot-password-example');
    Route::get('/reset-password-example', ResetPasswordExample::class)->name('reset-password-example');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bootstrap-tables', BootstrapTables::class)->name('bootstrap-tables');
    Route::get('/lock', Lock::class)->name('lock');
    Route::get('/buttons', Buttons::class)->name('buttons');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/forms', Forms::class)->name('forms');
    Route::get('/modals', Modals::class)->name('modals');
    Route::get('/typography', Typography::class)->name('typography');
    Route::get('/typography', Typography::class)->name('typography');



    Route::prefix('employees')->group(function () {
        Route::get('/', Employees::class)->name('employees')->middleware('permission:viewAllEmployees');
        Route::get('/addEmployee', AddNewEmployee::class)->name('employees.addNew');#->middleware('permission:addEmployees');
        Route::get('/{user}/edit', Edit::class)->name('employees.edit');
        Route::get('/remove/{user}', [Employees::class, 'Remove'])->name('employees.remove')->middleware('permission:deleteEmployee');
        Route::get('/lateness', Latenesses::class)->name('employees.lateness'); //->middleware('permission:viewAllEmployees');
        Route::get('/overtime', Overtimes::class)->name('employees.overtime'); //->middleware('permission:viewAllEmployees');

    });


    Route::prefix('leaves')->group(function () {
        Route::get('/', Leaves::class)->name('leaves');
        Route::get('/{leave}/approve', [Leaves::class, 'approve'])->name('leaves.approve')->middleware('permission:leaveReqAction');
        Route::get('/{leave}/reject', [Leaves::class, 'reject'])->name('leaves.reject')->middleware('permission:leaveReqAction');
    });


    Route::prefix('vacations')->group(function () {
        Route::get('/', Vacations::class)->name('vacations');
        Route::get('/{vacation}/approve', [Vacations::class, 'approve'])->name('vacations.approve')->middleware('permission:vactionReqAction');
        Route::get('/{vacation}/reject', [Vacations::class, 'reject'])->name('vacations.reject')->middleware('permission:vactionReqAction');
    });


    Route::prefix('attendence')->group(function () {
        Route::get('/', Attendences::class)->name('attendences')->middleware('permission:viewAttendence');
    });


    Route::prefix('schedule')->group(function () {
        Route::get('/', Schedule::class)->name('schedule');
        Route::get('/set-schedule', SetSchedule::class)->name('schedule.set');
    });



    Route::prefix('permissions')->group(function () {
        Route::get('/', Permissions::class)->name('permissions'); //->middleware('permission:viewPermissions')
        Route::get('/{user}/edit', PermissionEdit::class)->name('permissions.edit'); //->middleware('permission:editPermissions')
        Route::get('/roles', PermissionRoles::class)->name('permissions.roles'); //->middleware('permission:editPermissions')
        Route::get('/roles/{role}/edit', PermissionRolesEdit::class)->name('permissions.role.edit'); //->middleware('permission:editPermissions')

    });




    Route::prefix('roles')->group(function () {
        Route::get('/', Roles::class)->name('roles'); //->middleware('role:viewroles')
        Route::get('/addNewRole', AddnewRole::class)->name('role.addNew'); //->middleware('role:viewroles')
        Route::get('/{role}/edit', PermissionRolesEdit::class)->name('permissions.role.edit');
        Route::get('/{role}/remove', Roles::class, 'remove')->name('role.remove');
    });



    Route::prefix('deductions')->group(function () {
        Route::get('/', DeductionsController::class)->name('deductions'); //->middleware('role:viewroles')
    });

    Route::prefix('allownces')->group(function () {
        Route::get('/', AllowncesController::class)->name('allownces'); //->middleware('role:viewroles')
    });


    Route::prefix('payroll')->group(function () {
        Route::get('/salaries', Salaries::class)->name('payroll.salaries'); //->middleware('role:viewroles')
        Route::get('/addSalary', AddSalaries::class)->name('payroll.addSalary'); //->middleware('role:viewroles')
    });

});
