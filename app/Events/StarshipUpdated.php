<?php

namespace App\Events;

use App\Models\Starship;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StarshipUpdated implements ShouldBroadcast
{
    public $starship;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param  Starship  $starship
     * @return void
     */
    public function __construct(Starship $starship)
    {
        $this->starship = $starship;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('popup_channel');
    }

    public function broadcastAs()
    {
        return 'starship-updated';
    }
}