<?php

namespace Tests\Feature\App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FilesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_upload_file()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('api.files.upload'), [
            'file' => UploadedFile::fake()->create('image.jpg', 100),
        ], [
            'Accept' => 'application/json',
        ]);

        //the response should include a file url
        $response->assertJSONStructure(['url']);
        //get the file url from the response
        $url = $response->json('url');
        //the file should be stored in the storage
        $path = 'uploaded-files/' . basename($url);
        Storage::disk('public')->assertExists($path);
        //assert that the file you get from the url has the same content as the file you uploaded
        $this->assertEquals(
            Storage::disk('public')->get($path),
            Storage::disk('public')->get($response->json('url'))
        );
        //the response should have a 201 status code
        $response->assertStatus(201);
    }

    public function test_uploaded_file_must_be_valid_type()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('api.files.upload'), [
            'file' => UploadedFile::fake()->create('document.pdf', 100),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertJsonValidationErrors('file');

        $response->assertStatus(422);
    }

    public function test_uploaded_file_must_be_within_limit()
    {
        $user = User::factory()->create();

        $limitInKB = config('app.uploads.max_size');

        //assert that uploading the limit should work
        $response = $this->actingAs($user)->post(route('api.files.upload'), [
            'file' => UploadedFile::fake()->create('large_document.jpg', $limitInKB),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(201);

        //assert that uploading a file larger than the limit should fail
        $response = $this->actingAs($user)->post(route('api.files.upload'), [
            'file' => UploadedFile::fake()->create('large_document.jpg', $limitInKB + 1),
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertJsonValidationErrors('file');
        $response->assertStatus(422);
    }
}
