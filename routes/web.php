<?php

use App\Livewire\Recipes;
use App\Livewire\ViewRecipe;
use Illuminate\Support\Facades\Route;

Route::get('/', Recipes::class);
Route::get('/recipe/{slug}', ViewRecipe::class);
