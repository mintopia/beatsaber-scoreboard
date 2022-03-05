<?php

namespace App\Providers;

use App\Models\ApiKey;
use App\Models\Leaderboard;
use App\Models\Score;
use App\Observers\ApiKeyObserver;
use App\Observers\LeaderboardObserver;
use App\Observers\ScoreObserver;
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
        ApiKey::observe(ApiKeyObserver::class);
    }
}
