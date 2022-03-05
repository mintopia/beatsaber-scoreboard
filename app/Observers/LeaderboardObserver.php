<?php

namespace App\Observers;

use App\Models\Leaderboard;

class LeaderboardObserver
{
    /**
     * Handle the Leaderboard "created" event.
     *
     * @param  \App\Models\Leaderboard  $leaderboard
     * @return void
     */
    public function created(Leaderboard $leaderboard)
    {
        if ($leaderboard->active) {
            $leaderboard->ensureOnlyActiveBoard();
        }
        $leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the Leaderboard "updated" event.
     *
     * @param  \App\Models\Leaderboard  $leaderboard
     * @return void
     */
    public function updated(Leaderboard $leaderboard)
    {
        if ($leaderboard->active) {
            $leaderboard->ensureOnlyActiveBoard();
        }
        $leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the Leaderboard "deleted" event.
     *
     * @param  \App\Models\Leaderboard  $leaderboard
     * @return void
     */
    public function deleted(Leaderboard $leaderboard)
    {
        $leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the Leaderboard "restored" event.
     *
     * @param  \App\Models\Leaderboard  $leaderboard
     * @return void
     */
    public function restored(Leaderboard $leaderboard)
    {
        //
    }

    /**
     * Handle the Leaderboard "force deleted" event.
     *
     * @param  \App\Models\Leaderboard  $leaderboard
     * @return void
     */
    public function forceDeleted(Leaderboard $leaderboard)
    {
        //
    }
}
