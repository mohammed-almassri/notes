<?php
namespace App\Services\Auth\Responses;

use App\Models\User;

class LoginResponse
{
    public function __construct(public User $user, public string $token)
    {
    }
}
