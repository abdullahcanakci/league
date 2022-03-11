<?php

use App\Http\Resources\TeamResource;
use App\Models\Team;

test('lists teams', function () {

    Team::factory()->count(5)->create();

    /** @var \Tests\TestCase $this */
    $this
        ->get(route('teams.index'))
        ->assertStatus(200)
        ->assertJsonCount(5, 'data')
        ->assertJson(['data' => TeamResource::collection(Team::all())->jsonSerialize()]);
});

test('list limits teams', function () {
    Team::factory()->count(5)->create();

    /** @var \Tests\TestCase $this */
    $this
        ->get(route('teams.index', ['number_of_teams' => 2]))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});
