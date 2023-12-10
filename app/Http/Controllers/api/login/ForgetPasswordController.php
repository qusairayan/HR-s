<?php

namespace App\Http\Controllers\api\login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\ForgetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use App\Notifications\ForgetPasswordNotification;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(ForgetPasswordRequest $request){
        $request->validated();
        $user = User::where("email",$request->only("email"))->first();
        $user->notify(new ForgetPasswordNotification());
        return response()->json(["success"=>true,'message'=>"A code has been sent to the requested email"],200);
    }
    public function forget(Request $request)
    {

        if ($request->has('email')) {


            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            $email = $request->input('email');

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email address.',
                ],201);
            }


            $user = User::where('email', 'LIKE', $email)->first();;

            if ($user) {


                $otp = rand(100000, 999999);
                Mail::raw("Your OTP is: $otp", function ($message) use ($email) {
                    $message->to($email)
                        ->subject('One-Time Password (OTP)');
                });


                $user->otp = $otp;
                $user->save();


                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully.',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Undefined Email",
                ], 201);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Missed Email",
            ],201);
        }
    }








    public function verifyOtp(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 201);
        }

        // Verify the OTP
        $otp = $request->input('otp');

        // Retrieve the stored OTP from the session


        $email = $request->input('email');

        $user = User::where('email', 'LIKE', $email)->first();;
        $storedOtp = $user->otp;

        if (!$storedOtp || $otp != $storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',


            ], 201);
        }


        $user->otp = '';
        $response = Password::broker()->createToken($user);

        $user->save();


        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.',
            'token' => $response

        ], 200);
    }




    public function resetPassword(Request $request){
// Validate the request data
$validator = Validator::make($request->all(), [
    'token' => 'required',
    'password' => 'required|min:8',
    'email' => 'required|email|exists:users,email'
]);
if ($validator->fails()) {
    return response()->json([
        'success' => false,
        'message' => 'Invalid credentials.',
        'errors' => $validator->errors(),
        ], 400);
}
$email=$request->input('email');

// return response()->json(request()->input('password'));
$Password = Hash::make(request()->input('password'));

$token=$request->input('token');

$user=User::where('email',$email)->first();
// return response()->json($user);
if (Password::broker()->tokenExists($user, $token)) {
$user->password=$Password;
$user->save();
return response()->json([
    'success' => true,
    'message' => 'Password has been changed successfully.',
    ], 200); 
}
else{
    return response()->json([
        'success' => false,
        'message' => 'Invalid token.',
        ], 201);   
}
    }
}
