<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int week
 * @property int season_id
 * @property int home_team_id
 * @property int away_team_id
 * @property int|null home_goals
 * @property int|null away_goals
 * 
 */
class Fixture extends Model
{
    use HasFactory;

    /* PROPERTIES */

    protected $guarded = ['id'];

    /* RELATIONS */

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
}
