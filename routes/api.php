<?php

use App\Http\Controllers\RecipesController;
use Illuminate\Support\Facades\Route;

Route::get('/recipes', RecipesController::class)->name('recipes.index');

