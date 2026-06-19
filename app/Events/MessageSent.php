<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use SerializesModels;

    public $message;

    public function __construct($message)
    {
        // Load user relation for JS
        $this->message = $message->load('user');
    }

    public function broadcastOn()
    {
        // VERY IMPORTANT
        return new Channel('forum.' . $this->message->forum_id);
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }
}
?>