<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'category_id' => Category::inRandomOrder()->first(),
            'instructions' => $this->faker->paragraph,
            'duration' => $this->faker->time('H:i'),
            'published' => $this->faker->boolean,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Recipe $recipe) {
            $ingredients = Ingredient::inRandomOrder()->take(5)->pluck('id');
            $recipe->ingredients()->attach($ingredients);
        });
    }
}
