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
    public $order;
    public $details;
    public $channel;
    public $order_;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $details, $empresaId, $order_)
    {
        $this->order = $order;
        $this->details = $details;
        $this->channel = $empresaId;
        $this->order_ = $order_;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ordersCompany.'.$this->channel);
        // return new PrivateChannel('channel-name');
    }
}
