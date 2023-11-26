<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\login\LoginController;
use App\Http\Controllers\api\login\ForgetPasswordController;
use App\Http\Controllers\api\attendence\AttendanceController;
use App\Http\Controllers\api\attendence\attendenceRecord;
use App\Http\Controllers\Api\Attendence\AttendenceToday;
use App\Http\Controllers\Api\Auth\ForgetPasswordController as AuthForgetPasswordController;
use App\Http\Controllers\api\Auth\LoginController as AuthLoginController;//app/Http/Controllers/api/Auth/LoginController
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\ResetPassword;
use App\Http\Controllers\Api\Auth\VerfyOtpController;
use App\Http\Controllers\api\leaves\LeaveReqController;
use App\Http\Controllers\api\leaves\GetLeaveController;
use App\Http\Controllers\api\vacations\VacationReqController;
use App\Http\Controllers\api\vacations\GetVacationController;
use App\Http\Controllers\api\profile\ProfileController;
use App\Http\Controllers\api\profile\showProfileImageController;
Route::middleware(['api'])->group(function () {
Route::post('/profile', [ProfileController::class, 'profile']); 
});
Route::middleware(["guest"])->prefix("auth")->name("auth.")->group(function(){
    Route::post("login"          , [AuthLoginController::class          ,'login' ])->name("login");
    Route::post("register"       , [RegisterController::class           ,"create"])->name("register");
    Route::post('forget-password', [AuthForgetPasswordController::class ,'forgetPassword'])->name("forgetPassword");
    Route::post('verfy-otp'      , [VerfyOtpController::class, 'verifyOtp'])->name("verfyOtp");
    Route::post('reset-password' , [ResetPassword::class, 'ResetPassword'])->name("resetPassword");
});

// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/ActivateOtp', [LoginController::class, 'sendOtp']);
// Route::post('/ActivateVerifyOtp', [LoginController::class, 'verifyOtp']);

Route::post('/attendence', [AttendanceController::class, 'attendence']);
Route::post("attendence/record",[attendenceRecord::class,"recordApi"])->name("attendence.record.api");
Route::post("attendence/schedule",[attendenceRecord::class,"getSchedule"])->name("attendence.getSchedule.api");

Route::post('/leaveReq', [LeaveReqController::class, 'leaveReq']);
Route::post('/vacationReq', [VacationReqController::class, 'vacationReq']);
Route::post('/getVacation', [GetVacationController::class, 'getVacations']);
Route::post('/getLeave', [GetLeaveController::class, 'getLeaves']);

Route::post('/getProfile', [ProfileController::class, 'getProfile']);
Route::post('/profileOTP', [ProfileController::class, 'profileOTP']);
Route::post('/updateProfile', [ProfileController::class, 'editProfile']);
Route::post('/profilePassword', [ProfileController::class, 'profilePassword']);
Route::post('/profileIMG/{filename}', [showProfileImageController::class, 'showProfileImage']);

// Route::post("/register",[Register::class,"create"])->name("register");
// Route::post("/delete",[Register::class,"destroy"])->name("delete");
// Route::post('forget-password', [ForgetPasswordController::class, 'forget']);
// Route::post('forget-password-otp', [ForgetPasswordController::class, 'verifyOtp']);
// Route::post('reset-password', [ForgetPasswordController::class, 'resetPassword']);
Route::middleware(["auth:sanctum"])->group(function(){
    Route::get("attendence/today",[AttendenceToday::class,"AttendenceToday"])->name("today");
    Route::get("auth/logout",[AuthLoginController::class,"logout"])->name("logout");
    // Route::prefix("profile")->name("profile.")->group(function(){
    //     Route::put("edit",[ProfileController::class, 'editProfile'])->name("edit");
    //     Route::put("password",[ProfileController::class, 'editProfile'])->name("password");
    // });
    // Route::prefix("attendence")->name("attendence.")->group(function(){
    //     Route::get("/today",[AttendenceToday::class,"AttendenceToday"])->name("today");
    //     Route::post('/', [AttendanceController::class, 'attendence']);
    //     Route::post("attendence/record",[attendenceRecord::class,"recordApi"])->name("attendence.record.api");
    //     Route::post("attendence/schedule",[attendenceRecord::class,"getSchedule"])->name("attendence.getSchedule.api");
    // });
    // Route::prefix("leave")->name("leave.")->group(function(){
    //     Route::post('/', [AttendanceController::class, 'attendence']);
    //     Route::post("attendence/record",[attendenceRecord::class,"recordApi"])->name("attendence.record.api");
    //     Route::post("attendence/schedule",[attendenceRecord::class,"getSchedule"])->name("attendence.getSchedule.api");
    // });
});
