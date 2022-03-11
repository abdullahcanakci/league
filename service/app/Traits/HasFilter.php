<?php

namespace App\Traits;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

/** 
 * Applies filtering to the models
 */
trait HasFilter
{
    public function scopeFilter(Builder $query, Filter $filter = null): Builder
    {
        if (is_null($filter)) {
            $filter = app($this->filterClass ?? Filter::class);
        }
        return $filter->apply($query);
    }
}
