<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Queries\SearchRecipes;
use Illuminate\Http\Request;
use SmoothPhp\QueryBus\QueryBus;

class RecipesController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request)
    {
        return RecipeResource::collection($this->queryBus->query(new SearchRecipes()));
    }
}
