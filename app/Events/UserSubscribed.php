<?php

namespace App\Events;

use App\Models\Website;
use App\Models\Subscribers;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserSubscribed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $subscriber;
    public $website;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subscribers $subscriber, Website $website)
    {
        $this->subscriber = $subscriber;
        $this->website = $website;
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
