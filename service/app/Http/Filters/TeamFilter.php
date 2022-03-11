<?php

namespace App\Http\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;

class TeamFilter extends Filter
{
    public function numberOfTeams($count)
    {
        $this->builder->limit($count);
    }
}
