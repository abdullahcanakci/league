<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\IndexRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;

class TeamController extends Controller
{
    public function index(IndexRequest $request)
    {
        return TeamResource::collection(Team::filter()->get());
    }
}
