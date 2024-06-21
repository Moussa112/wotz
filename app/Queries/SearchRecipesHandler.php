<?php

namespace App\Queries;

use App\Filters\SearchFilter;
use App\Models\Recipe;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchRecipesHandler
{
    public function handle(SearchRecipes $query)
    {
        return QueryBuilder::for(Recipe::class)
            ->published()
            ->with(['category', 'ingredients'])
            ->allowedIncludes(['category', 'ingredients'])
            ->allowedFilters([
                AllowedFilter::exact('category.name'),
                AllowedFilter::custom('search', new SearchFilter()),
            ])->get();
    }
}
