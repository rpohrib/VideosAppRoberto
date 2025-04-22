<?php

namespace Tests\Unit;

use App\Models\Series;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function serie_have_videos()
    {
        // Create a series
        $series = Series::factory()->create();

        // Create videos and associate them with the series
        $videos = Video::factory()->count(3)->create(['series_id' => $series->id]);

        // Assert that the series has the videos
        $this->assertCount(3, $series->videos);
        $this->assertTrue($series->videos->contains($videos->first()));
    }
}
