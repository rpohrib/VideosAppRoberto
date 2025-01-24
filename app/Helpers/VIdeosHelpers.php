<?php

namespace App\Helpers;

class VIdeosHelpers
{
    public static function getDefaultVideo()
    {
        return [
            [
            'title' => 'BMW M4',
            'description' => '2021 BMW M4 Competition Review // M Is For Monster',
            'url' => 'https://www.youtube.com/embed/63JZ5IGXqm8',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
        ],
        [
            'title' => 'Audi R8 V10',
            'description' => '2020 Audi R8 V10 Performance Review // The $240,000 Domesticated Maniac',
            'url' => 'https://www.youtube.com/embed/Wzg8hPq9FtQ',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => 2,
        ],
        [
            'title' => 'Ford Mustang',
            'description' => '2024 Ford Mustang GT Review // $50,000 V8 Champion',
            'url' => 'https://www.youtube.com/embed/pyAkHBjNLS8',
            'published_at' => now(),
            'previous' => null,
            'next' => null,
            'series_id' => 3,
        ],
        ];
    }
}
