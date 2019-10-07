<?php

Route::get('/', 'CompetitionController@index')->name('home');

Route::get('login', 'LoginController@login')->name('login');
Route::get('login/redirect', 'LoginController@redirect')->name('login.redirect');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::name('admin.')->prefix('admin')->namespace('Admin')->middleware(['auth', 'can:admin'])->group(function() {
    Route::resource('competitions', 'CompetitionController');
    Route::resource('players', 'PlayerController')->except(['create', 'store']);
    Route::resource('leaderboards', 'LeaderboardController')->except(['index']);
    Route::resource('scores', 'ScoreController')->except(['index', 'create']);
    Route::resource('apikeys', 'ApiKeyController')->except(['show']);
});

Route::get('{competition}', 'CompetitionController@show')->name('competitions.show');