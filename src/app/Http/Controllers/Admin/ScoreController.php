<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Player;
use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{

    public function store(ScoreRequest $request, Leaderboard $leaderboard)
    {
        DB::beginTransaction();
        $player = Player::whereName($request->input('name'))->first();
        if (!$player) {
            $player = new Player;
            $player->name = $request->input('name');
            $player->save();
        }
        $score = new Score;
        $score->leaderboard()->associate($leaderboard);
        $score->player()->associate($player);
        $score->setScore($request->input('score'));
        $score->save();
        DB::commit();
        return response()->redirectToRoute('admin.leaderboards.show', $leaderboard)->with('successMessage', 'The score has been added');
    }

    public function edit(Score $score)
    {
        return view('admin.scores.edit', [
            'score' => $score
        ]);
    }

    public function update(ScoreUpdateRequest $request, Score $score)
    {
        $score->setScore($request->input('score'));
        $score->save();
        return response()->redirectToRoute('admin.leaderboards.show', $score->leaderboard)->with('successMessage', 'The score has been updated');
    }

    public function delete(Score $score)
    {
        $score->delete();
        return response()->redirectToRoute('admin.leaderboards.show', $score->leaderboard)->with('successMessage', 'The score has been deleted');
    }
}
