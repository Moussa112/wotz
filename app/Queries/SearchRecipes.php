<?php

namespace App\Queries;

class SearchRecipes
{
    public function __construct(public ?string $search = null, public ?string $category = null)
    {
    }
}
