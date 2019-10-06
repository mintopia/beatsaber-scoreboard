<?php

namespace App\Http\Controllers\Api\V1;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BeatSaberReportRequest;
use App\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function beatsaber(BeatSaberReportRequest $request, Competition $competition)
    {
        DB::beginTransaction();
        $leaderboard = $competition->leaderboards()->whereKey($request->input('key'))->first();
        if (!$leaderboard) {
            $leaderboard = new Leaderboard;
            $leaderboard->associate($competition);
            $leaderboard->key = $request->input('key');
            $leaderboard->name = $leaderboard->key;
            $leaderboard->save();
        }

        $score = $leaderboard->addScore($request->input('name'), $request->input('score'));
        return new ScoreResource($score);
    }
}
