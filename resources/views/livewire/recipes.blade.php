<div>
    <section class="p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live="search" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search recipe..." required="">
                            </div>
                        </form>
                    </div>
                    <div>
                        <select wire:model.live="category" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="0">Choose a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}"> {{ $category }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Recipe Name</th>
                            <th scope="col" class="px-4 py-3">Category</th>
                            <th scope="col" class="px-4 py-3">Ingredients</th>
                            <th scope="col" class="px-4 py-3">Instructions</th>
                            <th scope="col" class="px-4 py-3">Duraction</th>
                            <th scope="col" class="px-4 py-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recipes as $recipe)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 dark:text-white"> {{ $recipe->title }} </th>
                                <td class="px-4 py-3">{{ $recipe->category->name }}</td>
                                <td class="px-4 py-3">
                                    <ul>
                                        @forelse($recipe->ingredients as $ingredient)
                                            <li>{{ $ingredient->name }}</li>
                                        @empty
                                            No ingredients.
                                        @endforelse
                                    </ul>
                                </td>
                                <td class="px-4 py-3">{{ $recipe->instructions }}</td>
                                <td class="px-4 py-3"> {{ $recipe->duration }} </td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button wire:navigate href="/recipe/{{ $recipe->slug }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 text-sm" colspan="3">
                                    No recipes were found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{$recipes->links()}}
            </div>
        </div>
    </section>
</div>
