<?php

namespace App\Providers;

use App\Leaderboard;
use App\Observers\LeaderboardObserver;
use App\Observers\ScoreObserver;
use App\Score;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Score::observe(ScoreObserver::class);
        Leaderboard::observe(LeaderboardObserver::class);
    }
}
