<?php

use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\CompetitionController as AdminCompetitionController;
use App\Http\Controllers\Admin\LeaderboardController;
use App\Http\Controllers\Admin\ScoreController;
use App\Http\Controllers\Admin\ApiKeyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ApiLogController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\LoginController;

use Illuminate\Support\Facades\Route;

Route::get('/', [CompetitionController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('login/redirect', [LoginController::class, 'redirect'])->name('login.redirect');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::name('admin.')->prefix('admin')->middleware(['auth', 'can:admin'])->group(function() {
    Route::resource('competitions', AdminCompetitionController::class)->except(['edit']);
    Route::resource('players', PlayerController::class)->except(['create']);
    Route::resource('competitions/{competition}/leaderboards', LeaderboardController::class)->only(['create', 'store']);
    Route::resource('leaderboards', LeaderboardController::class)->except(['index', 'create', 'store', 'edit']);
    Route::resource('leaderboards/{leaderboard}/scores', ScoreController::class)->only(['store']);
    Route::resource('scores', ScoreController::class)->only(['destroy']);
    Route::resource('apikeys', ApiKeyController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('apilogs', ApiLogController::class)->only(['index', 'show']);
});

Route::get('competitions/{competition}', [CompetitionController::class, 'show'])->name('competitions.show');
