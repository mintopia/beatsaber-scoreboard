<?php

namespace App\Jobs;

use App\Models\Competition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessBeatSaberScore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected Competition $competition, protected object $payload)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        $leaderboard = $this->competition->leaderboards()->where('key', $this->payload->key)->first();
        if (!$leaderboard) {
            $leaderboard = new Leaderboard;
            $leaderboard->competition()->associate($this->competition);
            $leaderboard->key = $this->payload->key;
            $leaderboard->name = $this->payload->leaderboardName;
            $leaderboard->save();
        }

        $leaderboard->addScore($this->payload->name, $this->payload->score);
        DB::commit();
    }
}
