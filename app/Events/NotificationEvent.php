<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;

    public function __construct($_data)
    {
        $this->data = $_data;
    }

    public function broadcastOn()
    {
        return ['notification-channel'];
    }
}
