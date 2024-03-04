<?php

namespace Tests\Feature\App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin()
    {
        //create user
        $user = User::factory()->create();
        //send request
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function testRegister()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'user@gmail.com']);

        $response->assertStatus(200);
    }
}
