<?php

namespace App\Observers;

use App\Leaderboard;

class LeaderboardObserver
{
    /**
     * Handle the leaderboard "created" event.
     *
     * @param  \App\Leaderboard  $leaderboard
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
     * Handle the leaderboard "updated" event.
     *
     * @param  \App\Leaderboard  $leaderboard
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
     * Handle the leaderboard "deleted" event.
     *
     * @param  \App\Leaderboard  $leaderboard
     * @return void
     */
    public function deleted(Leaderboard $leaderboard)
    {
        $leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the leaderboard "restored" event.
     *
     * @param  \App\Leaderboard  $leaderboard
     * @return void
     */
    public function restored(Leaderboard $leaderboard)
    {
        //
    }

    /**
     * Handle the leaderboard "force deleted" event.
     *
     * @param  \App\Leaderboard  $leaderboard
     * @return void
     */
    public function forceDeleted(Leaderboard $leaderboard)
    {
        //
    }
}
