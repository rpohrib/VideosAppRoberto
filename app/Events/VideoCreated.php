<?php

namespace App\Events;

use App\Models\Video;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $video;

    /**
     * Crea una nova instància de l'event.
     *
     * @param $video
     */
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return new PrivateChannel('videos');
    }

    /**
     * Get the event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'video.created';
    }



}
