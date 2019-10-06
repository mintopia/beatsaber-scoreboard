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
        return $this->edit($request, $competition);
    }

    public function show(Competition $competition)
    {
        return view('admin.competitions.show', [
            'competition' => $competition
        ]);
    }

    public function edit(CompetitionRequest $request, Competition $competition)
    {
        $competition->name = $request->input('name');
        $competition->style = $request->input('style');
        $competition->active = (bool) $request->input('active');
        $competition->description = $request->input('description');
        $competition->save();
        return response()->redirectToRoute('admin.competitions.show', $competition);
    }

    public function delete(Competition $competition)
    {
        $competition->delete();
        return response()->redirectToRoute('admin.competitions.index')->with('successMessage', 'The competition has been removed');
    }

}
