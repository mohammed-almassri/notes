<?php

namespace Tests\Feature\App\Http\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_note()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        //upload an image to use as the note image
        $response = $this->post(route('api.files.upload'), [
            'file' => \Illuminate\Http\UploadedFile::fake()->image('image.jpg'),
        ]);

        $url = $response->json('url');

        $response = $this->postJson(route('api.notes.store'), [
            'title' => 'Test Note',
            'description' => 'This is a test note',
            'image_url' => $url,
        ]);
        $response->assertStatus(201);
    }

    public function test_can_update_note()
    {
        $user = \App\Models\User::factory()->create();
        $note = $user->notes()->create([
            'title' => 'Test Note',
            'description' => 'This is a test note',
        ]);
        $this->actingAs($user);
        $response = $this->putJson(route('api.notes.update', ['note' => $note->id])
            , [
                'title' => 'Updated Note',
                'description' => 'This is an updated note',
            ]);

        //assert that the note was updated
        $this->assertEquals('Updated Note', $note->fresh()->title);
        $this->assertEquals('This is an updated note', $note->fresh()->description);

        $response->assertStatus(200);
    }
}
