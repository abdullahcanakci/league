<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 * @property int year
 * @property int week
 * @property boolean concluded
 * 
 * @method static Builder active()
 * 
 */
class Season extends Model
{
    use HasFactory;

    /* PROPERTIES */

    protected $guarded = ['id'];

    /* RELATIONS */

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }

    public function standings(): HasMany
    {
        return $this->hasMany(SeasonStanding::class);
    }

    /* SCOPES */

    public static function scopeActive(Builder $query): Builder
    {
        return $query->where(['concluded' => false]);
    }

    /* HELPERS */

    public function advance()
    {
        if ($this->week == 6) {
            $this->concluded = true;
            $this->week = null;
        } else {
            $this->week = $this->week + 1;
        }
        $this->save();
    }

    public function calculateChances()
    {
        $standings = $this->standings()->orderBy('points', 'desc')->get();
        $leader = $standings->first();
        $remainingPoints = (6 - ($this->week - 1)) * 3;

        if ($this->concluded) {
            $this->standings()->update(['chance' => 0]);
            info('concluded');
            if ($leader->points > $standings[1]->points) {
                info('first place');
                $leader->refresh();
                info($leader);
                $leader->chance = 100;
                $leader->save();
                info($leader);
            } else {
                info('shares first place');
            }
        } else {
            // Calculates if each team has fulfilled their potential points by the current week
            // And calculates their 
            $standings->each(function ($standing) use ($leader, $remainingPoints) {
                info(sprintf('leader %s remaining %s standing %s', $leader->points, $remainingPoints, $standing->points));
                $potentialPoints = $standing->points + $remainingPoints;
                if ($standing->team_id != $leader->id && $leader->points > $potentialPoints) {
                    // Team doesnt have any chance to catch up to the leader.
                    $standing->chance = 0;
                } else {
                    // Team has collect most of X% of points
                    $standing->chance = $potentialPoints / (($this->week - 1) * 3);
                }
            });
            $total = $standings->sum('chance');
            // Normalize the percentages.
            $standings->each(fn ($standing) => $standing->chance = number_format(($standing->chance / $total) * 100, 1));
            $standings->each->save();
        }
    }
}
