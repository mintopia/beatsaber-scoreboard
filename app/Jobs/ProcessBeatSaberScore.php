<?php

namespace App\Jobs;

use App\Exceptions\MapNotFoundException;
use App\Models\Competition;
use App\Models\Leaderboard;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            try {
                $leaderboard->updateFromBeatSaver();
                $leaderboard->save();
            } catch (MapNotFoundException $ex) {
                DB::rollBack();
                Log::warning("Unable to find {$this->payload->key} in BeatSaver");
                return;
            }
            $leaderboard->save();
        }

        $leaderboard->addScore($this->payload->name, $this->payload->score);
        DB::commit();
    }
}
