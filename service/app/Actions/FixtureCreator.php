<?php

namespace App\Actions;

use App\Models\Fixture;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class FixtureCreator
{
    protected Collection $teams;
    protected Season $season;

    public function __construct(Season $season, Collection $teams)
    {
        $this->teams = $teams;
        $this->season = $season;
    }

    public function handle()
    {
        $numberOfTeams = $this->teams->count();

        if ($numberOfTeams == 0) {
            return;
        }

        $numberOfMatches = 2 * $numberOfTeams * ($numberOfTeams - 1) / 2;

        // For 4 team group numberOfMatches will be 12 and weeks will be 3,
        // since each team plays each other twice, we can duplicate the first half / phase
        // and reverse home/away teams to calculate all 6 weeks. 
        $weeks = $numberOfMatches / $numberOfTeams;

        $fixtures = collect();
        $this->teams->each(function ($team) use (&$fixtures) {
            $opposingTeams = $this->teams->where('id', '!=', $team->id);
            $opposingTeams->each(function ($opposingTeam) use ($team, &$fixtures) {

                // Check if there is a previous fixture for the teams;
                $previous = $fixtures->first(
                    fn ($fixture) => $fixture['home'] == $opposingTeam->id && $fixture['away'] == $team->id ||
                        $fixture['home'] == $team->id && $fixture['away'] == $opposingTeam->id

                );

                if ($previous) {
                    // Teams have an arranged match in this half
                    return;
                }

                $fixtures->push([
                    'home' => $team->id,
                    'away' => $opposingTeam->id
                ]);
            });
        });

        for ($week = 1; $week <= $weeks; $week++) {
            $this->season->fixtures()->create([
                'week' => $week,
                'home_team_id' => $fixtures[$week - 1]['home'],
                'away_team_id' => $fixtures[$week - 1]['away'],
            ]);

            $this->season->fixtures()->create([
                'week' => $week,
                'home_team_id' => $fixtures[$fixtures->count() - $week]['home'],
                'away_team_id' => $fixtures[$fixtures->count() - $week]['away'],
            ]);
        }

        /** @var Collection<Fixture> */
        $firstWeekFixtures = $this->season
            ->fixtures()
            ->get();


        // Fold the week to create reverse home/away matches
        $firstWeekFixtures->each(
            fn ($fixture) =>
            $fixture
                ->replicate()
                ->fill([
                    'week' => $weeks + $fixture->week,
                    'home_team_id' => $fixture->away_team_id,
                    'away_team_id' => $fixture->home_team_id
                ])
                ->save()
        );

        $this->teams->each(fn ($team) => $this->season->standings()->create(['team_id' => $team->id]));
    }

    public static function create(Season $season, Collection $teams): Season
    {
        $creator = new self($season, $teams);
        $creator->handle();

        return $season;
    }
}
