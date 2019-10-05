<?php

Route::get('/', 'CompetitionController@index')->name('home');
Route::get('/{competition}', 'CompetitionController@show')->name('competitions.show');

Route::name('admin.')->namespace('Admin')->group(function() {
    Route::resource('competition', 'CompetitionController');
    Route::resource('player', 'PlayerController')->except(['create', 'store']);
    Route::resource('leaderboard', 'LeaderboardController')->except(['index']);
    Route::resource('score', 'ScoreController')->except(['index', 'create']);
});
