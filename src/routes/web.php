<?php

Route::get('/', 'CompetitionController@index')->name('home');
Route::get('/{competition}', 'CompetitionController@show')->name('competitions.show');

Route::name('admin.')->prefix('admin')->namespace('Admin')->group(function() {
    Route::resource('competitions', 'CompetitionController');
    Route::resource('players', 'PlayerController')->except(['create', 'store']);
    Route::resource('leaderboards', 'LeaderboardController')->except(['index']);
    Route::resource('scores', 'ScoreController')->except(['index', 'create']);
    Route::resource('apikeys', 'ApiKeyController')->except(['show']);
});
