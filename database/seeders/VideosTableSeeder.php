<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Helpers\VIdeosHelpers;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $defaultVideos = VIdeosHelpers::getDefaultVideo();
        foreach ($defaultVideos as $video) {
            \App\Models\Video::create ($video);
        }
    }
}
