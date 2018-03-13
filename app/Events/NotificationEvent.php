<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

//QUESTION_DETECT : ?????????????????(https://laravel10.wordpress.com/2015/05/25/events/)?????

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
        //QUESTION_DETECT : ?????????????????
    }
}

//QUESTION_DETECT : listener???
