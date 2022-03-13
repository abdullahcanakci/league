<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function playWeek(Season $season)
    {
        info($season);
        if (!$season->concluded) {
            $fixtures = $season->fixtures()->where('week', $season->week)->get();

            // TODO: move logic into model
            if ($season->week == 6) {
                $season->concluded = true;
                $season->week = null;
            } else {
                $season->week = $season->week + 1;
            }
            $season->save();

            $fixtures->each(
                fn ($fixture) =>
                $fixture->update([
                    'home_goals' => mt_rand(0, 3),
                    'away_goals' => mt_rand(0, 3)
                ])
            );
        }

        $season->load('fixtures.homeTeam', 'fixtures.awayTeam', 'standings.team');
        return SeasonResource::make($season);
    }
}
