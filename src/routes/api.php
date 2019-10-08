<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['apilogger', 'auth.api'])->prefix('/v1/')->name('api.v1.')->namespace('Api\V1')->group(function() {
    Route::get('ping', function() {
        return new \App\Http\Resources\Api\V1\PingResource(null);
    })->name('ping');

    Route::post('competitions/{competition}/report/beatsaber', 'ReportController@beatsaber')->name('report.beatsaber');
});
