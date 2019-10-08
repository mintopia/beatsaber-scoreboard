<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Leaderboard
 *
 * @property int $id
 * @property int $competition_id
 * @property string $name
 * @property int $active
 * @property string $score_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Competition $competition
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Score[] $scores
 * @property-read int|null $scores_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereScoreType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $key
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leaderboard whereKey($value)
 */
class Leaderboard extends Model
{
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
        return $score;
    }
}
