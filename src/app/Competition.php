<?php

namespace App;

use App\Events\CompetitionRefresh;
use App\Events\CompetitionUpdate;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Competition
 *
 * @property int $id
 * @property string $name
 * @property string $permalink
 * @property string $style
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Leaderboard[] $leaderboards
 * @property-read int|null $leaderboards_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition wherePermalink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereDescription($value)
 * @property int $follow_scores
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Competition whereFollowScores($value)
 */
class Competition extends Model
{
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
