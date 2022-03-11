<?php

namespace App\Models;

use App\Http\Filters\TeamFilter;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory, HasFilter;

    protected string $filterClass = TeamFilter::class;
}
