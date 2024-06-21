<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class SearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where(function (Builder $query) use ($value) {
            $query->where('title', 'like', '%' . $value . '%')
                ->orWhereHas('ingredients', function (Builder $query) use ($value) {
                    $query->where('name', '=', '%' . $value . '%');
                });
        });
    }
}
