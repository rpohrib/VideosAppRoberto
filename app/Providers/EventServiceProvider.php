<?php

namespace App\Providers;

class EventServiceProvider
{
    protected $listen = [
        \App\Events\VideoCreated::class => [
            \App\Listeners\SendVideoCreatedNotification::class,
        ],
    ];
}
