<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int team_id
 * @property int plays
 * @property int wins
 * @property int draws
 * @property int loses
 */
class SeasonStanding extends Model
{
    use HasFactory;

    /* PROPERTIES */

    protected $guarded = ['id'];

    /* RELATIONS */

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
