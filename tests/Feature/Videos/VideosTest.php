<?php

namespace Tests\Feature\Videos;

use App\Helpers\UserHelpers;
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

    /** @test */
    public function user_without_permissions_can_see_default_videos_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('videos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('videos.index');
    }

    /** @test */
    public function user_with_permissions_can_see_default_videos_page()
    {
        $user = UserHelpers::create_video_manager_user();
        $this->actingAs($user);

        $response = $this->get(route('videos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('videos.index');
    }

    /** @test */
    public function not_logged_users_can_see_default_videos_page()
    {
        $response = $this->get(route('videos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('videos.index');
    }
}
