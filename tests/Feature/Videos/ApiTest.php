<?php

namespace Feature\Videos;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_store_video_success()
    {
        // Simulate authenticated user
        $this->actingAs(User::factory()->create());

        // Fake storage
        Storage::fake('public');

        // Mock video file
        $file = UploadedFile::fake()->create('video.mp4', 1024, 'video/mp4');

        // Send POST request
        $response = $this->postJson('/api/videos', [
            'video' => $file,
        ]);

        // Assert response
        $response->assertStatus(201)
            ->assertJson(['message' => 'Video uploaded successfully']);

        // Assert file was stored
        Storage::disk('public')->assertExists('videos/' . $file->hashName());
    }

    public function test_store_video_validation_error()
    {
        // Simulate authenticated user
        $this->actingAs(User::factory()->create());

        // Send POST request without a file
        $response = $this->postJson('/api/videos', []);

        // Assert validation error
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['video']);
    }

    public function test_store_video_unauthorized()
    {
        // Send POST request without authentication
        $response = $this->postJson('/api/videos', []);

        // Assert unauthorized error
        $response->assertStatus(401);
    }
}
