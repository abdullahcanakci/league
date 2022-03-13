<?php

use App\Models\Fixture;
use App\Models\Season;
use App\Models\Team;
use Database\Factories\TeamFactory;

it('calculates standing for newly concluded match', function () {
    $teams = Team::factory(2)->create();
    $season = Season::factory()
        ->create();

    $teams->each(fn ($team) => $season->standings()->create(['team_id' => $team->id]));

    $fixture = $season->fixtures()->create(
        ['home_team_id' => $teams[0]->id, 'away_team_id' => $teams[1]->id, 'week' => 1]
    );

    $homeStanding = $season->standings()->where('team_id', $teams[0]->id)->first();

    expect($homeStanding->goals)->toBe(0);
    expect($homeStanding->wins)->toBe(0);

    $fixture->update(['home_goals' => 2]);

    $homeStanding->refresh();
    expect($homeStanding->goals)->toBe(2);
    expect($homeStanding->wins)->toBe(1);
    expect($homeStanding->points)->toBe(3);
});
