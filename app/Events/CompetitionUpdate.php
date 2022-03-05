<?php

namespace App\Events;

use App\Models\Competition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompetitionUpdate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Competition $competition;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }

    public function broadcastWith()
    {
        $leaderboard = $this->competition->leaderboards()->where('active', true)->first();
        if (!$leaderboard) {
            return [
                'leaderboard' => (object) [
                    'name' => 'No Scores',
                    'scores' => [],
                ]
            ];
        }
        return [
            'leaderboard' => (object) [
                'name' => $leaderboard->name,
                'scores' => $leaderboard->topScores(100),
            ]
        ];
    }

    public function broadcastOn()
    {
        return new Channel("competition.{$this->competition->id}");
    }

    public function broadcastAs()
    {
        return 'competition.update';
    }
}
