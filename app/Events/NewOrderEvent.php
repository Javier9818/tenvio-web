<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderEvent implements ShouldBroadcast
{
    public $channel;
    //public $details;
    public $order;

    public function __construct($empresaId, $order)
    {
        $this->channel = $empresaId;
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return new Channel('ordersCompany.'.$this->channel);
        // return new PrivateChannel('channel-name');
    }
}
