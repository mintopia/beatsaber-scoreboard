<?php

Route::get('/', 'CompetitionController@index')->name('home');

Route::get('login', 'LoginController@login')->name('login');
Route::get('login/redirect', 'LoginController@redirect')->name('login.redirect');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::name('admin.')->prefix('admin')->namespace('Admin')->middleware(['auth', 'can:admin'])->group(function() {
    Route::resource('competitions', 'CompetitionController')->except(['edit']);
    Route::resource('players', 'PlayerController')->except(['create', 'store']);
    Route::resource('competitions/{competition}/leaderboards', 'LeaderboardController')->only(['create', 'store']);
    Route::resource('leaderboards', 'LeaderboardController')->except(['index', 'create', 'store', 'edit']);
    Route::resource('leaderboards/{leaderboard}/scores', 'ScoreController')->only(['store']);
    Route::resource('scores', 'ScoreController')->only(['destroy']);
    Route::resource('apikeys', 'ApiKeyController')->except(['show']);
    Route::resource('users', 'UserController')->except(['show']);
});

Route::get('competitions/{competition}', 'CompetitionController@show')->name('competitions.show');
