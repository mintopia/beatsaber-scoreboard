<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function show(Player $player)
    {
        return view('admin.players.show', [
            'player' => $player
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
        $player->name = $request->name;
        return response()->redirectToRoute('admin.players.show', $player);
    }

    public function delete(Player $player)
    {
        $player->delete();
        return response()->redirectToRoute('admin.players.index')->with('successMessage', 'The player has been deleted');
    }
}
