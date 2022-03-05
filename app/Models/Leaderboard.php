<?php

namespace App\Models;

use App\Exceptions\MapNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Leaderboard extends Model
{
    use HasFactory;

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class)->orderBy('score', 'DESC');
    }

    public function ensureOnlyActiveBoard()
    {
        $others = $this->competition->leaderboards()->where('active', true)->where('id', '<>', $this->id)->get();
        foreach ($others as $other) {
            $other->active = false;
            $other->save();
        }
    }

    // TODO: Refactor to service
    public function updateFromBeatSaver()
    {
        if (!$this->key) {
            return;
        }
        if ($this->name) {
            return;
        }
        $response = Http::get("https://api.beatsaver.com/maps/hash/{$this->key}");
        if ($response->successful()) {
            $this->name = $response->json('name');
        } else {
            throw new MapNotFoundException;
        }
    }

    public function uniqueScores()
    {
        switch ($this->score_type) {
            case ScoreType::TIME:
                $order = 'MIN(score) ASC';
                break;
            default:
                $order = 'MAX(score) DESC';
                break;
        }

        return $this->scores()
            ->select([
                 'id',
                 DB::raw('MAX(score) AS score'),
                 'player_id',
                 'leaderboard_id',
                 'created_at',
                 'updated_at',
             ])
            ->orderByRaw($order)
            ->with('player')
            ->groupBy('player_id');
    }

    public function topScores($limit)
    {
        $scores = $this->uniqueScores()->limit($limit)->get();

        $table = $scores->map(function (Score $score) {
            return (object) [
                'score' => $score->score,
                'name' => $score->player->name
            ];
        });
        return $table->toArray();
    }

    public function addScore($name, $value)
    {
        // See if we already exist
        $existing = $this->scores()->where('score', $value)->whereHas('player', function($query) use ($name) {
            $query->where('name', $name);
        })->first();
        if ($existing) {
            return $existing;
        }
        $player = Player::where('name', $name)->first();
        if (!$player) {
            $player = new Player;
            $player->name = $name;
            $player->save();
        }
        $score = new Score;
        $score->leaderboard()->associate($this);
        $score->player()->associate($player);
        $score->setScore($value);
        $score->save();
        if ($this->competition->follow_scores) {
            $this->active = true;
            $this->save();
        }
        return $score;
    }
}
