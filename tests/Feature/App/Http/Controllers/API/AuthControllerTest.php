<?php

namespace Tests\Feature\App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        //create user
        $user = User::factory()->create();
        //send request
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        //assert the structure has a user and a token and the user has a name, email and id

        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
            ],
            'token',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'user@gmail.com']);
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
            ],
            'token',
        ]);

        $response->assertStatus(200);
    }
}
