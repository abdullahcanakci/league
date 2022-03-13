<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use Illuminate\Database\Eloquent\Collection;

class FixtureController extends Controller
{
    public function playWeek(Season $season)
    {
        if (!$season->concluded) {
            $fixtures = $season->fixtures()->where('week', $season->week)->get();
            /** @var Collection */
            $standings = $season->standings()->orderBy('points', 'desc')->get();

            // TODO: move logic into model
            if ($season->week == 6) {
                $season->concluded = true;
                $season->week = null;
            } else {
                $season->week = $season->week + 1;
            }
            $season->save();

            $fixtures->each(
                function ($fixture) use ($standings) {

                    // Leading team has 33% higher goal avarage
                    $homeStanding = $standings->first(fn ($s) => $s->team_id == $fixture->home_team_id);
                    $awayStanding = $standings->first(fn ($s) => $s->team_id == $fixture->away_team_id);


                    $fixture->update([
                        'home_goals' => mt_rand($homeStanding->points > $awayStanding->points ? 1 : 0, 3),
                        'away_goals' => mt_rand($awayStanding->points > $homeStanding->points ? 1 : 0, 3)
                    ]);
                }
            );
            $season->calculateChances();
        }

        $season->load('fixtures.homeTeam', 'fixtures.awayTeam', 'standings.team');
        return SeasonResource::make($season);
    }
}
