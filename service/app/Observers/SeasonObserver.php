<?php

namespace App\Observers;

use App\Models\Season;

class SeasonObserver
{
    public function creating(Season $season)
    {
        if (is_null($season->year)) {
            $previousSeason = Season::query()->orderBy('year', 'desc')->first();

            $season->year = optional($previousSeason)->year + 1 ?? 2022;
        }
    }
}
