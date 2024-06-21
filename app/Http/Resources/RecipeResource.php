<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'instructions' => $this->instructions,
            'duration' => $this->duration,
            'published' => $this->published,
            'ingredients' => $this->whenLoaded('ingredients', function () {
                return IngredientResource::collection($this->ingredients);
            }),
        ];
    }
}
