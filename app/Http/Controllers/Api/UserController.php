<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user;
            // ->createToken('token')->accessToken;
            return response()->json(['token' => $token], 200);
        } catch (\Throwable $th) {
            return $this->exceptionJsonResponse($th);
        }
    }

    public function login(Request $request)
    {
        return $request->all();
    }
}
