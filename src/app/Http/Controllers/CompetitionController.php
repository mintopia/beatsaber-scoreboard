<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $params = [];
        $query = Competition::query();
        $query->orderBy('name', 'ASC');
        $query->whereActive(true);
        $query->whereHas('leaderboards', function($query) {
            $query->whereActive(true);
        });

        $params['per_page'] = $request->input('per_page', 10);
        $competitions = $query->paginate($params['per_page'])->appends($params);

        return view('competitions.index', [
            'competitions' => $competitions
        ]);
    }

    public function show(Competition $competition)
    {
        if (!$competition->active) {
            throw new ModelNotFoundException('Competition not found');
        }
        $leaderboard = $competition->leaderboards()->whereActive(true)->first();
        if (!$leaderboard) {
            throw new ModelNotFoundException('Leaderboard not found');
        }
        return view('leaderboards.show', [
            'leaderboard' => $leaderboard,
            'scores' => $leaderboard->topScores(100),
        ]);
    }
}
