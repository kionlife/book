<?php

// app/Events/MessageSent.php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;
    public $toUserId;

    public function __construct($message, $toUserId)
    {
        $this->message = $message;
        $this->toUserId = $toUserId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('private-chat.' . $this->toUserId);
    }

    public function broadcastWith() {
        return ["message" => $this->message];
    }
}
