<?php

namespace App\Events;

use App\Models\MyCase;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyCaseStatusChangedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * The MyCase instance.
     *
     * @var \App\Models\MyCase
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MyCase $myCase)
    {
        $this->myCase = $myCase;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
