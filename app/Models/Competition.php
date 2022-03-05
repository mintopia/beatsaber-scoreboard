<?php

namespace App\Models;

use App\Events\CompetitionRefresh;
use App\Events\CompetitionUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    public function leaderboards()
    {
        return $this->hasMany(Leaderboard::class);
    }

    public function refreshBoard()
    {
        event(new CompetitionRefresh($this));
    }

    public function pushUpdate()
    {
        event(new CompetitionUpdate($this));
    }
}
