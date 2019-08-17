<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SubmitQuestion
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $id;
    public $question;
    public $user_name;
    public $event_id;
    public $created_at;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $question, $user_name, $event_id, $created_at)
    {
        //
        $this->id = $id;
        $this->question = $question;
        $this->user_name = $user_name;
        $this->event_id = $event_id;
        $this->created_at = $created_at;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('question-channel');
    }

    public function broadcastAs(){
        return 'question-submitted';
    }
}
