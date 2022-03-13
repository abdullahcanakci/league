<?php

use App\Models\Season;
use App\Models\SeasonStanding;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('tests 1 ', function () {
    /** @var Season */
    $season = Season::factory(['week' => 6])
        ->create();

    $standings = SeasonStanding::factory(4)
        ->state(new Sequence(
            ['plays' => 5, 'wins' => 2, 'draws' => 2, 'loses' => 1],
            ['plays' => 5, 'wins' => 2, 'draws' => 1, 'loses' => 1],
            ['plays' => 5, 'wins' => 1, 'draws' => 1, 'loses' => 1],
            ['plays' => 5, 'wins' => 1, 'draws' => 2, 'loses' => 2],
        ))
        ->for($season)
        ->for(Team::factory())
        ->create();

    $season->calculateChances();
});
