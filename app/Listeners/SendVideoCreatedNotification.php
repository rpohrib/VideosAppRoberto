<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use App\Mail\VideoCreatedMail;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
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
        // Dispatch the event to ensure it is broadcasted
//        event($event);

        // Get all admin users
//        $admins = User::where('super_admin' == 1)->get();

        Mail::to("rpohrib@iesebre.com")->send(new VideoCreatedMail($event->video));

        // Send notification to admins
        //Notification::send($admins, new VideoCreatedNotification($event->video));
    }
}
