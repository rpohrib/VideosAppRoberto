<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendVideoCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\VideoCreated $event
     * @return void
     */
    public function handle(VideoCreated $event)
    {
        // Get all admin users
        $admins = User::where('is_admin', true)->get();

        // Send notification to admins
        Notification::send($admins, new VideoCreatedNotification($event->video));
    }
}
