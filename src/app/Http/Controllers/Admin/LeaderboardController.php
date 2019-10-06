<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaderboardRequest;
use App\Leaderboard;

class LeaderboardController extends Controller
{
    public function create(Competition $competition)
    {
        return view('admin.leaderboards.create', [
            'competition' => $competition
        ]);
    }

    public function store(LeaderboardRequest $request, Competition $competition)
    {
        $leaderboard = new Leaderboard;
        $leaderboard->competition()->associate($competition);
        return $this->update($request, $competition);
    }

    public function show(Leaderboard $leaderboard)
    {
        return view('admin.leaderboards.show', $leaderboard);
    }

    public function edit(Leaderboard $leaderboard)
    {
        return view('admin.leaderboards.edit', $leaderboard);
    }

    public function update(LeaderboardRequest $request, Leaderboard $leaderboard)
    {
        $leaderboard->name = $request->input('name');
        $leaderboard->score_type = $request->input('score_type');
        $leaderboard->active = (bool) $request->input('active');
        $leaderboard->key = $request->input('key');
        $leaderboard->save();
        return response()->redirectToRoute('admin.leaderboards.show', $leaderboard);
    }

    public function delete(Leaderboard $leaderboard)
    {
        $leaderboard->delete();
        return response()->redirectToRoute('admin.competitions.show', $leaderboard->competition)->with('successMessage', 'The leaderboard has been deleted');
    }
}
