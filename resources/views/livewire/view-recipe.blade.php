<div>
    <section class="p-3 ">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h2 class="text-4xl font-extrabold dark:text-white">{{ $recipe->title }}</h2>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $recipe->category->name }}</span><br>
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-pink-600 bg-pink-200 uppercase last:mr-0 mr-1">
                {{ $recipe->duration }}
            </span>
            <p class="my-4 text-lg text-gray-500">{{ $recipe->instructions }}</p>
            <p class="mb-4 text-lg text-white">Ingredients:</p>
            <td class="px-4 py-3">
                <ul>
                    @forelse($recipe->ingredients as $ingredient)
                        <li class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $ingredient->name }}</li>
                    @empty
                        No ingredients.
                    @endforelse
                </ul>
            </td>
        </div>
    </section>

    <section class="p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <h3 class="font-extrabold dark:text-white mb-2">Random recipes in the same category</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($randomRecipes as $randomRecipe)
                    <a href="{{ $randomRecipe->slug  }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $randomRecipe->title }}</h5>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $randomRecipe->category->name }}</span><br>
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-pink-600 bg-pink-200 uppercase last:mr-0 mr-1">
                    {{ $randomRecipe->duration }}
                </span>
                    </a>
                @empty
                    No other products found in this category.
                @endforelse
            </div>
        </div>
    </section>
</div>
