<?php

use App\Actions\FixtureCreator;
use App\Models\Fixture;
use App\Models\Season;
use App\Models\Team;

use function Pest\Laravel\assertDatabaseCount;

it('creates correct number of matches', function () {
    $teams = Team::factory(4)->create();
    $season = Season::factory()->create();

    FixtureCreator::create($season, $teams);

    // For a group of 4 total of 12 matches will be playerd.
    assertDatabaseCount('fixtures', 12);
});

test('no overlapping matches created for any team in week', function () {
    $teams = Team::factory(4)->create();
    $season = Season::factory()->create();

    FixtureCreator::create($season, $teams);

    $weeks = Fixture::all()->groupBy('week');

    foreach ($weeks as $week) {
        $weekTeams = array_merge($week->pluck('home_team_id')->toArray(), $week->pluck('away_team_id')->toArray());
        info($weekTeams);
        expect(count($weekTeams))->toBe(count(array_unique($weekTeams)));
    }
});
