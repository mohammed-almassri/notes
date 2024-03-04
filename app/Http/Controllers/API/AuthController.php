<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate a token for the user
        $token = auth()->user()->createToken('authToken')->plainTextToken;

        return response([
            'user' => auth()->user(),
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the token
        $request->user()->token()->revoke();

        return response([
            'message' => 'You have been successfully logged out',
        ]);
    }

    public function user(Request $request)
    {
        return response([
            'user' => $request->user(),
        ]);
    }

    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate a token for the user
        $token = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $token,
        ]);
    }
}
