<?php

namespace App\Events;

use App\Models\Competition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompetitionRefresh implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(protected Competition $competition)
    {
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
