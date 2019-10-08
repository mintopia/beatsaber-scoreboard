<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaderboardRequest;
use App\Leaderboard;
use Illuminate\Http\Request;

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
        return $this->update($request, $leaderboard);
    }

    public function show(Request $request, Leaderboard $leaderboard)
    {
        $params = [];
        if ($request->input('unique', false)) {
            $params['unique'] = true;
            $query = $leaderboard->uniqueScores();
        } else {
            $query = $leaderboard->scores()->orderBy('score', 'DESC');
        }

        $params['per_page'] = $request->input('per_page', 10);
        $scores = $query->paginate($params['per_page'])->appends($params);
        return view('admin.leaderboards.show', [
            'leaderboard' => $leaderboard,
            'scores' => $scores,
            'params' => $params,
        ]);
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

    public function destroy(Leaderboard $leaderboard)
    {
        $leaderboard->delete();
        return response()->redirectToRoute('admin.competitions.show', $leaderboard->competition)->with('successMessage', 'The leaderboard has been deleted');
    }
}
