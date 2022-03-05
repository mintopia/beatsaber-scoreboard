<?php

namespace App\Observers;

use App\Models\Score;

class ScoreObserver
{
    /**
     * Handle the Score "created" event.
     *
     * @param  \App\Models\Score  $score
     * @return void
     */
    public function created(Score $score)
    {
        $score->leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the Score "updated" event.
     *
     * @param  \App\Models\Score  $score
     * @return void
     */
    public function updated(Score $score)
    {
        $score->leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the Score "deleted" event.
     *
     * @param  \App\Models\Score  $score
     * @return void
     */
    public function deleted(Score $score)
    {
        $score->leaderboard->competition->pushUpdate();
    }

    /**
     * Handle the Score "restored" event.
     *
     * @param  \App\Models\Score  $score
     * @return void
     */
    public function restored(Score $score)
    {
        //
    }

    /**
     * Handle the Score "force deleted" event.
     *
     * @param  \App\Models\Score  $score
     * @return void
     */
    public function forceDeleted(Score $score)
    {
        //
    }
}
