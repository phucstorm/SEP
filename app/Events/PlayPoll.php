<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PlayPoll implements ShouldBroadCast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $answerId;
    public $answerContent;
    public $multiChoice;
    public $pollContent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $answerId, $answerContent, $multiChoice, $pollContent)
    {
        //
        $this->id = $id;
        $this->answerId = $answerId;
        $this->answerContent = $answerContent;
        $this->multiChoice = $multiChoice;
        $this->pollContent = $pollContent;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('play-poll-channel');
    }
  
    public function broadcastAs()
    {
        return 'play-poll';
    }
}
