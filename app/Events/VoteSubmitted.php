<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VoteSubmitted implements ShouldBroadCast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $answerArray;
    public $sumVotes;
    public $votes;
    public $answerContent;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($answerArray,$sumVotes,$votes,$answerContent)
    {
        //
        $this->answerArray = $answerArray;
        $this->sumVotes = $sumVotes;
        $this->votes = $votes;
        $this->answerContent = $answerContent;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('vote-channel');
    }

    public function broadcastAs()
    {
        return 'vote-submitted';
    }
}
