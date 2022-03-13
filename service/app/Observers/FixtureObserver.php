<?php

namespace App\Observers;

use App\Models\Fixture;
use App\Models\SeasonStanding;

class FixtureObserver
{

    public function updated(Fixture $fixture)
    {
        $standings = $fixture
            ->season
            ->standings()
            ->whereIn('team_id', [$fixture->away_team_id, $fixture->home_team_id])
            ->get();

        /** @var SeasonStanding */
        $homeStanding = $standings->first(fn ($standing) => $standing->team_id == $fixture->home_team_id);
        /** @var SeasonStanding */
        $awayStanding = $standings->first(fn ($standing) => $standing->team_id == $fixture->away_team_id);

        // TODO: check if this function is an update and negate previous updates



        $awayStanding->update([
            'plays' => $awayStanding->plays + 1,
            'goals' => $awayStanding->goals + $fixture->away_goals,
            'goals_conceded' => $awayStanding->goals + $fixture->home_goals,
            'draws' => $awayStanding->draws + (($fixture->away_goals == $fixture->home_goals) ? 1 : 0),
            'wins' => $awayStanding->wins + (($fixture->away_goals > $fixture->home_goals) ? 1 : 0),
            'loses' => $awayStanding->loses + (($fixture->away_goals < $fixture->home_goals) ? 1 : 0),
        ]);

        $homeStanding->update([
            'plays' => $homeStanding->plays + 1,
            'goals' => $homeStanding->goals + $fixture->home_goals,
            'goals_conceded' => $homeStanding->goals + $fixture->away_goals,
            'draws' => $homeStanding->draws + (($fixture->home_goals == $fixture->away_goals) ? 1 : 0),
            'wins' => $homeStanding->wins + (($fixture->home_goals > $fixture->away_goals) ? 1 : 0),
            'loses' => $homeStanding->loses + (($fixture->home_goals < $fixture->away_goals) ? 1 : 0),
        ]);
    }
}
