<?php


namespace App\QueryFilters;


use Illuminate\Database\Eloquent\Builder;

class Name extends Filter
{
    protected function applyFilter(Builder $builder): Builder
    {
        $search = request($this->filterName());

        return $builder->where('name', 'like', "%$search%");
    }
}
