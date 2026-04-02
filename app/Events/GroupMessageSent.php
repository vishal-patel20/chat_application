<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageId;
    public $senderId;

    public function __construct($messageId, $senderId)
    {
        $this->messageId = $messageId;
        $this->senderId = $senderId;
    }

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('group.chat'),
        ];
    }
}
