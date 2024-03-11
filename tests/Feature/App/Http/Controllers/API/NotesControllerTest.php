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
            'id' => \Str::uuid(),
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
            'id' => \Str::uuid(),
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

    public function test_can_delete_note()
    {
        $user = \App\Models\User::factory()->create();
        $note = $user->notes()->create([
            'id' => \Str::uuid(),
            'title' => 'Test Note',
            'description' => 'This is a test note',
        ]);
        $this->actingAs($user);
        $response = $this->deleteJson(route('api.notes.destroy', ['note' => $note->id]));

        //assert that the note was deleted softly
        $this->assertSoftDeleted($note);

        $response->assertStatus(204);
    }

    public function test_can_get_note()
    {
        $user = \App\Models\User::factory()->create();
        $note = $user->notes()->create([
            'id' => \Str::uuid(),
            'title' => 'Test Note',
            'description' => 'This is a test note',
        ]);
        $this->actingAs($user);
        $response = $this->getJson(route('api.notes.show', ['note' => $note->id]));

        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'image_url',
        ]);

        $response->assertStatus(200);
    }

    public function test_can_get_all_notes()
    {
        $user = \App\Models\User::factory()->create();
        $notes = $user->notes()->createMany([
            [
                'id' => \Str::uuid(),
                'title' => 'Test Note 1',
                'description' => 'This is a test note 1',
            ],
            [
                'id' => \Str::uuid(),
                'title' => 'Test Note 2',
                'description' => 'This is a test note 2',
            ],
        ]);
        $this->actingAs($user);
        $response = $this->getJson(route('api.notes.index'));

        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'description',
                'image_url',
            ],
        ]);

        $response->assertStatus(200);
    }
}
