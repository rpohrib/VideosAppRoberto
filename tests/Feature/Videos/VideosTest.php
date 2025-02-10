<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_view_videos()
    {
        $video = Video::create([
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'https://example.com/video',
            'published_at' => now(),
            'series_id' => 1,
        ]);

        $response = $this->get(route('videos.show', $video->id));

        $response->assertStatus(200);
        $response->assertViewIs('videos.show');
        $response->assertViewHas('video', $video);
    }
}
