<?php

use App\Http\Resources\SeasonResource;
use App\Models\Season;

it('creates a new season ', function () {
    /** @var \Tests\TestCase $this */
    $this
        ->post(route('seasons.store'))
        ->assertStatus(201);

    expect(Season::first())->toBeObject();
});

it('shows a season', function () {
    $season = Season::factory()->create();

    /** @var \Tests\TestCase $this */
    $this
        ->get(route('seasons.show', ['season' => $season->id]))
        ->assertStatus(200)
        ->assertJson(['data' => SeasonResource::make($season)->jsonSerialize()]);
});
