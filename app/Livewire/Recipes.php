<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Recipes extends Component
{
    use WithPagination;

    #[Url]
    public ?string $search = null;

    #[Url]
    public ?string $category = null;

    public ?Collection $categories = null;

    public function mount()
    {
        $this->categories = Category::pluck('name');
    }

    public function updating($key): void
    {
        if ($key === 'searchRecipesTerm' || $key === 'category') {
            $this->resetPage();
        }
    }

    public function render()
    {
        //TODO preferably use SearchRecipes query but im not not too familiar with livewire/component lifecycles if this
        // is acceptable or if there is a "good" way to inject the query bus.
        // $recipes = $this->queryBus->query(new SearchRecipes($this->searchRecipesTerm, $this->category));

        $queryBuilder = QueryBuilder::for(Recipe::class)
            ->published()
            ->with(['category', 'ingredients']);

        if ($this->search) {
            $queryBuilder->where(function ($query) {
                $query->where('title', 'LIKE', '%' . $this->search . '%')
                    ->orWhereHas('ingredients', function ($ingredientQuery) {
                        $ingredientQuery->where('name', '=', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->category) {
            $queryBuilder->whereHas('category', function ($categoryQuery) {
                $categoryQuery->where('name', '=', $this->category);
            });
        }

        $recipes = $queryBuilder->paginate(10);

        return view('livewire.recipes', ['recipes' => $recipes]);
    }
}
