<?php

namespace App\Events;

use App\Models\License;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExpiringLicense implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $license;

    /**
     * Create a new event instance.
     */
    public function __construct( License $license)
    {
        $this->license = $license;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('licenseIsExpiring'),
        ];
    }
}
