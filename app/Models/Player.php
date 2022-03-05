<?php

namespace App\Models;

use App\Score;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
