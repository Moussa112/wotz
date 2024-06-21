<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        Category::factory()->count(12)->create();
        Ingredient::factory()->count(20)->create();
        Recipe::factory()->count(500)->create();
    }
}
