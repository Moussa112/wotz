<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Recipe;

class RecipeFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_filters_recipes_by_category()
    {
        $dinnerCategory = Category::factory()->create(['name' => 'dinner']);
        $lunchCategory = Category::factory()->create(['name' => 'lunch']);

        $italianRecipe = Recipe::factory()->create(['title' => 'Italian Recipe']);
        $italianRecipe->category()->associate($dinnerCategory)->save();

        $mexicanRecipe = Recipe::factory()->create(['title' => 'Mexican Recipe']);
        $mexicanRecipe->category()->associate($lunchCategory)->save();

        $this->assertDatabaseCount('categories', 2);
        $this->assertDatabaseCount('recipes', 2);

        $response = $this->get('/api/recipes?filter[category.name]=dinner');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment([
                'title' => 'Italian Recipe'
            ]);
    }

    /** @test */
    public function it_searches_recipes_by_title_and_ingredient()
    {
        $recipe1 = Recipe::factory()->create(['title' => 'Spaghetti Carbonara']);
        $recipe2 = Recipe::factory()->create(['title' => 'Guacamole']);

        $pastaIngredient = Ingredient::factory()->create(['name' => 'pasta']);
        $avocadoIngredient = Ingredient::factory()->create(['name' => 'avocado']);

        $recipe1->ingredients()->attach($pastaIngredient);
        $recipe2->ingredients()->attach($avocadoIngredient);

        $this->assertDatabaseCount('ingredients', 2);
        $this->assertDatabaseCount('recipes', 2);

        $response = $this->get('/api/recipes?filter[search]=pasta');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment([
                'title' => 'Spaghetti Carbonara'
            ]);
    }

    /** @test */
    public function it_searches_recipes_by_title_and_ingredient_and_category()
    {
        $dinnerCategory = Category::factory()->create(['name' => 'dinner'])->save();
        $lunchCategory = Category::factory()->create(['name' => 'lunch'])->save();

        $recipe1 = Recipe::factory()->create(['title' => 'Spaghetti Carbonara']);
        $recipe2 = Recipe::factory()->create(['title' => 'Guacamole']);
        $recipe3 = Recipe::factory()->create(['title' => 'Loempies']);

        $recipe1->category()->associate($dinnerCategory);
        $recipe2->category()->associate($dinnerCategory);
        $recipe3->category()->associate($lunchCategory);

        $pastaIngredient = Ingredient::factory()->create(['name' => 'pasta']);
        $avocadoIngredient = Ingredient::factory()->create(['name' => 'avocado']);

        $recipe1->ingredients()->attach($pastaIngredient);
        $recipe2->ingredients()->attach($avocadoIngredient);
        $recipe3->ingredients()->attach($pastaIngredient);

        $this->assertDatabaseCount('categories', 2);
        $this->assertDatabaseCount('ingredients', 2);
        $this->assertDatabaseCount('recipes', 3);

        $response = $this->get('/api/recipes?filter[category.name]=dinner&filter[search]=pasta');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment([
                'title' => 'Spaghetti Carbonara'
            ]);
    }
}
