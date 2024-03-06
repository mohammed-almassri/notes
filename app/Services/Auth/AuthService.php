<?php
namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Responses\LoginResponse;

class AuthService implements AuthServiceInterface
{
    public function login(array $credentials): LoginResponse
    {
        // Attempt to log the user in
        if (!auth()->attempt($credentials)) {
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate a token for the user
        $token = auth()->user()->createToken('authToken')->plainTextToken;

        return new LoginResponse(auth()->user(), $token);
    }

    public function register(array $data): LoginResponse
    {
        $user = User::create($data);
        $token = $user->createToken('authToken')->plainTextToken;

        return new LoginResponse($user, $token);
    }

    public function user(): User
    {
        return auth()->user();
    }
}
