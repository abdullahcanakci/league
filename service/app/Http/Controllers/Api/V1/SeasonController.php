<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\FixtureCreator;
use App\Http\Controllers\Controller;
use App\Http\Resources\SeasonResource;
use App\Models\Season;
use App\Models\Team;

class SeasonController extends Controller
{
    public function show(Season $season)
    {
        $season->load('fixtures.homeTeam', 'fixtures.awayTeam', 'standings.team');
        return SeasonResource::make($season);
    }

    public function store()
    {
        $season = Season::create(['concluded' => false]);

        FixtureCreator::create($season, Team::query()->inRandomOrder()->get());

        return SeasonResource::make($season);
    }
}
