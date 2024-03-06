<?php
namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Responses\LoginResponse;

interface AuthServiceInterface
{
    public function login(array $credentials): LoginResponse;
    public function register(array $data): LoginResponse;
    public function user(): User;
}
