<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Filter
{

    protected Request $request;

    protected Builder $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;;
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $name => $value) {
            $functionName = Str::camel($name);

            if (method_exists($this, $functionName) && !empty($value)) {
                call_user_func_array([$this, $functionName], [$value]);
            }
        }

        return $this->builder;
    }
}
