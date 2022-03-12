<?php

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('fills unset year', function () {
    /** @var Season */
    $season = Season::factory()->create();
    expect($season->year)->toBeInt();
});

it('respects preset year', function () {
    /** @var Season */
    $season = Season::factory(['year' => 2049])->create();

    expect($season->year)->toBe(2049);
});

it('increments previous year', function () {
    Season::factory(['year' => 2049])->create();
    /** @var Season */
    $season = Season::factory()->create();
    expect($season->year)->toBe(2050);
});


it('scopes ongoing years', function () {
    Season::factory()
        ->count(3)
        ->state(
            new Sequence(
                ['concluded' => true],
                ['concluded' => false],
                ['concluded' => true]
            )
        )
        ->create();

    /** @var Season */
    $activeSeason = Season::active()->first();
    expect($activeSeason->concluded)->toBeFalse();
});
