<?php

namespace Tests\Feature\App\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateNote()
    {
        //create user
        $user = \App\Models\User::factory()->create();

        //login user
        $this->actingAs($user);

        $response = $this->postJson('/api/notes', [
            'title' => 'Test Note',
            'description' => 'This is a test note',
        ]);

        $response->assertStatus(201);
    }
}
