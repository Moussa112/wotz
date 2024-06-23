<?php

namespace App\Livewire;

use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ViewRecipe extends Component
{
    public $recipe = [];

    public $randomRecipes;

    public function mount(string $slug)
    {
        $this->recipe = Recipe::findBySlug($slug);

        $cacheKey = 'random_recipes_' . $this->recipe->category->name . '_' . $this->recipe->id;
        $cacheDuration = Carbon::now()->secondsUntilEndOfDay();

        $this->randomRecipes = Cache::remember($cacheKey, $cacheDuration, function () {
            return Recipe::whereHas('category', function ($categoryQuery) {
                $categoryQuery->where('name', '=', $this->recipe->category->name);
            })
                ->published()
                ->with('category')
                ->where('id', '!=', $this->recipe->id)
                ->inRandomOrder()
                ->take(4)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.view-recipe');
    }
}
