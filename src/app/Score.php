<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Score
 *
 * @property int $id
 * @property int $leaderboard_id
 * @property int $player_id
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Leaderboard $leaderboard
 * @property-read \App\Player $player
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereLeaderboardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Score whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Score extends Model
{
    public function leaderboard()
    {
        return $this->belongsTo(Leaderboard::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function setScore($score)
    {
        $this->score = $score;
    }
}
