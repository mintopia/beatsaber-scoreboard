<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

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
