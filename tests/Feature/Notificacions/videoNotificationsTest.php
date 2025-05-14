<?php

namespace Feature\Notificacions;

use App\Events\VideoCreated;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class videoNotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_video_created_event_is_dispatched()
    {
        // Fake the event system
        Event::fake();

        // Create a video
        $video = Video::factory()->create();

        // Assert the VideoCreated event was dispatched
        Event::assertDispatched(VideoCreated::class, function ($event) use ($video) {
            return $event->video->id === $video->id;
        });
    }


    /** @test */
    public function test_push_notification_is_sent_when_video_is_created()
    {
        // Fake the notification system
        Notification::fake();

        // Create a video and dispatch the event
        $video = Video::factory()->create();
        VideoCreated::dispatch($video);

        // Assert a notification was sent
        Notification::assertSentTo(
            [$video->user], // Assuming the video has a related user
            \App\Notifications\VideoCreatedNotification::class,
            function ($notification, $channels) use ($video) {
                return $notification->video->id === $video->id;
            }
        );
    }
}
