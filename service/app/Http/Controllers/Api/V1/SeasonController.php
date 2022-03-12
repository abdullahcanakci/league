<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeasonResource;
use App\Models\Season;

class SeasonController extends Controller
{
    public function show(Season $season)
    {
        // TODO: load relations
        return SeasonResource::make($season);
    }

    public function store()
    {
        $season = Season::create();
        return SeasonResource::make($season);
    }
}
