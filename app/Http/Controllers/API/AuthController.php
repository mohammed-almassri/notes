<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        $response = $this->authService->login($request->only('email', 'password'));

        return response([
            'user' => $response->user,
            'token' => $response->token,
        ]);
    }

    public function user(Request $request)
    {
        return response([
            'user' => $this->authService->user(),
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

        // Register the user
        $response = $this->authService->register($request->all());

        return response([
            'user' => $response->user,
            'token' => $response->token,
        ]);
    }
}
