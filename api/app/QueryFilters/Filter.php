<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class Filter
{
    public function handle(Builder $builder, Closure $next): Builder
    {
        if (!request()->has($this->filterName())) {
            return $next($builder);
        }

        return $this->applyFilter($next($builder));
    }

    protected abstract function applyFilter(Builder $builder): Builder;

    protected function filterName(): string
    {
        return Str::camel(class_basename($this));
    }
}
