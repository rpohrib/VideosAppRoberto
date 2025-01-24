<?php

namespace Tests\Unit;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_formatted_published_at_date()
    {
        $video = Video::create([
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'https://example.com/video',
            'published_at' => Carbon::now(),
            'series_id' => 1,
        ]);

        $this->assertEquals(
            Carbon::parse($video->published_at)->translatedFormat('j \d\e F \d\e Y'),
            $video->formatted_published_at
        );
    }

    /** @test */
    public function can_get_formatted_published_at_date_when_not_published()
    {
        $video = Video::create([
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'https://example.com/video',
            'published_at' => null,
            'series_id' => 1,
        ]);


        $this->assertNull($video->published_at);
    }
}
