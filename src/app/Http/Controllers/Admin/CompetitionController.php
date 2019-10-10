<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index(Request $request)
    {
        $params = [];
        $query = Competition::query();

        $params['per_page'] = $request->input('per_page', 10);
        $competitions = $query->paginate($params['per_page'])->appends($params);

        return view('admin.competitions.index', [
            'competitions' => $competitions
        ]);
    }

    public function create()
    {
        return view('admin.competitions.create');
    }

    public function store(CompetitionRequest $request)
    {
        $competition = new Competition;
        return $this->update($request, $competition);
    }

    public function show(Request $request, Competition $competition)
    {
        $params = [];
        $query = $competition->leaderboards();
        $query->orderBy('created_at', 'DESC');
        $params['per_page'] = $request->input('per_page', 10);
        $leaderboards = $query->paginate($params['per_page'])->appends($params);
        return view('admin.competitions.show', [
            'competition' => $competition,
            'leaderboards' => $leaderboards
        ]);
    }

    public function update(CompetitionRequest $request, Competition $competition)
    {
        $competition->name = $request->input('name');
        $competition->style = $request->input('style');
        $competition->active = (bool) $request->input('active');
        $competition->follow_scores = (bool) $request->input('follow_scores');
        $competition->description = $request->input('description');
        $competition->save();
        return response()->redirectToRoute('admin.competitions.show', $competition);
    }

    public function destroy(Competition $competition)
    {
        $competition->delete();
        return response()->redirectToRoute('admin.competitions.index')->with('successMessage', 'The competition has been removed');
    }

}
