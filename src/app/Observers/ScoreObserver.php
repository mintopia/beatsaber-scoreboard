<?php

namespace App\Observers;

use App\Score;

class ScoreObserver
{
    /**
     * Handle the score "created" event.
     *
     * @param  \App\Score  $score
     * @return void
     */
    public function created(Score $score)
    {
        $score->leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the score "updated" event.
     *
     * @param  \App\Score  $score
     * @return void
     */
    public function updated(Score $score)
    {
        $score->leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the score "deleted" event.
     *
     * @param  \App\Score  $score
     * @return void
     */
    public function deleted(Score $score)
    {
        $score->leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the score "restored" event.
     *
     * @param  \App\Score  $score
     * @return void
     */
    public function restored(Score $score)
    {
        //
    }

    /**
     * Handle the score "force deleted" event.
     *
     * @param  \App\Score  $score
     * @return void
     */
    public function forceDeleted(Score $score)
    {
        //
    }
}
