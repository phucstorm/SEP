<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LikeQuestion implements ShouldBroadCast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $questionId;
    public $likes;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($questionId, $likes)
    {
        //
        $this->questionId = $questionId;
        $this->likes = $likes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('like-channel');
    }

    public function broadcastAs()
    {
        return 'like-question';
    }
}
