<?php

use App\Actions\FixtureCreator;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use App\Models\Team;

it('creates a new season ', function () {
    /** @var \Tests\TestCase $this */
    $this
        ->post(route('seasons.store'))
        ->assertStatus(201);

    expect(Season::first())->toBeObject();
});

it('shows a season', function () {
    $season = Season::factory()->create();
    $teams = Team::factory(4)->create();
    $team = $teams->first();

    FixtureCreator::create($season, $teams);
    $season = Season::find($season->id);
    /** @var \Tests\TestCase $this */
    $this
        ->get(route('seasons.show', ['season' => $season->id]))
        ->assertStatus(200)
        ->assertJson(['data' => SeasonResource::make($season)->jsonSerialize()])
        ->assertJsonFragment(['name' => $team->name]);
});
