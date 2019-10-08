<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Request $request)
    {
        $params = [];
        $query = Player::query();
        $query->orderBy('name', 'ASC');

        $params['per_page'] = $request->input('per_page', 10);
        $players = $query->paginate($params['per_page'])->appends($params);
        return view('admin.players.index', [
            'players' => $players
        ]);
    }

    public function store(PlayerRequest $request)
    {
        $player = new Player;
        return $this->update($request, $player);
    }

    public function show(Request $request, Player $player)
    {

        $params = [];
        $query = $player->scores()->with([
            'leaderboard',
            'leaderboard.competition',
        ]);
        $query->orderBy('created_at', 'DESC');

        $params['per_page'] = $request->input('per_page', 10);
        $scores = $query->paginate($params['per_page'])->appends($params);
        return view('admin.players.show', [
            'player' => $player,
            'scores' => $scores,
        ]);
    }

    public function edit(Player $player)
    {
        return view('admin.players.edit', [
            'player' => $player
        ]);
    }

    public function update(PlayerRequest $request, Player $player)
    {
        $player->name = $request->input('name');
        $player->save();
        return response()->redirectToRoute('admin.players.show', $player);
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return response()->redirectToRoute('admin.players.index')->with('successMessage', 'The player has been deleted');
    }
}
