<?php

namespace App\Http\Controllers\api\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\FlareClient\Http\Exceptions\InvalidData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function updateProfile(Request $request)
    {
        if (request()->has('id')) {
            $id = request()->input('id');


            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong Data'
                ], 201);
            }

            $user = User::where('id', $id)->first();

            $name = $request->input('name');
            $email = $request->input('email');

            
            if ($email != $user->email) {
                $userEmail = User::where('email', $email)->exists();
            if($userEmail){
                return response()->json([
                    'success' => false,
                    
                    'message' => 'Email Already Exist',
                ], 200);
            }

                $otp = rand(100000, 999999);

                Mail::raw("Your OTP is: $otp", function ($message) use ($email) {
                    $message->to($email)
                        ->subject('One-Time Password (OTP)');
                });
                if (request()->has('image')) {


                    $prevImg = $user->image;
                    if ($prevImg != '') {
                        Storage::delete('public/profile/' . $prevImg);
                    }



                    $image = $request->file('image');

                    $filename = $user->id . '.' . $image->getClientOriginalExtension();

                    $path = $image->storeAs('public/profile', $filename);
                    if ($path) {
                        $user->image = $id . '.' . $image->getClientOriginalExtension();
                    }
                }
                $user->name = $name;
                $user->otp = $otp;
                $user->save();
                


          
                return response()->json([
                    'success' => true,
                    'otpSent' => true,
                    'message' => 'OTP sent successfully to verify Email, Profile updated successfully ',
                ], 200);
            } else {


                if (request()->has('image')) {



                    $prevImg = $user->image;
                    if ($prevImg != '') {
                        Storage::delete('public/profile/' . $prevImg);
                    }


                    $image = $request->file('image');

                    $filename = $user->id . '.' . $image->getClientOriginalExtension();

                    $path = $image->storeAs('public/profile', $filename);
                    $user->image = $id . '.' . $image->getClientOriginalExtension();
                    $user->name = $name;
                    $user->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Profile updated successfully ',
                    ], 200);
                }


               

                return response()->json([
                    'success' => $name,
                    'message' => 'Profile updated successfully.',
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error: No user provided'
            ], 201);
        }
    }


    public function profileOTP(Request $request)
    {
     

        if (request()->has('id') && request()->has('otp') && request()->has('email')) {
            $id = request()->input('id');
            $otp = request()->input('otp');
            $email = request()->input('email');
            $user = User::where('id', $id)->first();

            if ($user->otp == $otp) {
                $user->email = $email;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Email updated successfully.',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP.',
                ], 201);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error: No user provided'
            ], 201);
        }
    }

    public function profilePassword(Request $request)
    {

        if (request()->has('id') && request()->has('password') && request()->has('newPassword')) {

            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'password' => 'required|string',
                'newPassword' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid password'
                ]);
            }
            $id = request()->input('id');

            $user = User::where('id', $id)->first();

            $password = request()->input('password');
            $newPassword = Hash::make(request()->input('newPassword'));
            if (Hash::check($password, $user->password)) {
                $user->password = $newPassword;
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Password has been Changed'
                ]);
            
            }
            return response()->json([
                'success' => false,
                'message' => 'Old password isn`t correct'
            ],201);
        
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Please, fill required fields'
            ], 201);
        }
    }
    public function getProfile(Request $request)
    {
        if (request()->has('id')) {
            $id = request()->input('id');

            $user = User::where('id', $id)->first();
            return response($user->image,200);
            if ($user) {

                if ($user->image){
                $user->image='https://'.request()->getHttpHost().'/storage/profile/'.$user->image;
                }
                return response()->json([
                    'success' => true,
                    'data' => $user,
                ], 200);
            } else {

                
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 201);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error: No user provided'
            ], 201);
        }
    }




}