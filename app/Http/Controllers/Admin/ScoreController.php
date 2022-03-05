<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Models\Leaderboard;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function store(ScoreRequest $request, Leaderboard $leaderboard)
    {
        $leaderboard->addScore($request->input('player'), $request->input('score'));
        return response()->redirectToRoute('admin.leaderboards.show', $leaderboard)->with('successMessage', 'The score has been added');
    }

    public function destroy(Score $score)
    {
        $score->delete();
        return back()->with('successMessage', 'The score has been deleted');
    }
}
