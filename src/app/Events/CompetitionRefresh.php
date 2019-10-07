<?php

namespace App\Events;

use App\Competition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow ;

class CompetitionRefresh implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $competition;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }


    public function broadcastOn()
    {
        return new Channel("competition.{$this->competition->id}");
    }

    public function broadcastAs()
    {
        return 'competition.refresh';
    }
}
