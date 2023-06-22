<?php

namespace App\Http\Controllers;

use App\Mail\OtpEmail;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Seshac\Otp\Otp;
use Throwable;

class AuthController extends Controller
{
    //
    public function signup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'contact_no' => 'required',
                'password' => 'required|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $input = $request->all();
            unset($input['password_confirmation']);
            $input['password'] = Hash::make($input['password']);
            $input['role'] = 'user';
            $user = User::create($input);

            // Generate OTP
            $otp = Otp::setValidity(20) // otp validity time in mins
                ->setLength(6)
                ->generate($request->email);

            // Code to send OTP to user email
            //$this->sendEmail($otp->token, $input['email']);

            return $this->successJsonResponse('Registration Successfull', ['user' => $user, 'otp' => $otp->token]);
            // return response()->json(['success' => $success], 200);

        } catch (Throwable $th) {
            Log::error('Registration failed: ' . $th);
            return $this->exceptionJsonResponse($th);
        }
    }

    public function sendEmail($otp, $email)
    {
        Mail::to($email)->send(new OtpEmail($otp));
    }

    public function verifyOtp(Request $request)
    {
        // Log::info(Otp::match($request->otp, $request->email));
        // Log::info($request->otp);
        // Log::info($request->email);

        try {
            $user = User::where('email', $request->email)->first();

            if ($user && Otp::validate($request->email, $request->otp)) {
                // OTP matched successfully
                return $this->successJsonResponse('OTP Verified', ['token' => $user->createToken('LaravelApp')->accessToken, 'user' => $user]);
                // return response()->json(, 200);
            } else {
                return $this->errorJsonResponse('Invalid OTP');
                //return response()->json(['error' => 'Invalid OTP'], 400);
            }
        } catch (Throwable $th) {
            return $this->exceptionJsonResponse($th);
        }
    }

    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('LaravelApp')->accessToken;
                return $this->successJsonResponse('Login successfull', ['token' => $token, 'user' => $user]);
            } else {
                return $this->errorJsonResponse('Invalid Credential');
            }
        } catch (Throwable $th) {
            return $this->exceptionJsonResponse($th);
        }
    }

}
