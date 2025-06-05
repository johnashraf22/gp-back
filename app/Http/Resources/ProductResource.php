<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->getFirstMediaUrl('image'),
            'images' => $this->getMedia('image')->map(function ($media) {
                return $media->getUrl();
            }),
            'category' => $this->category?->name,
            'type' => $this->category?->name,
            'user' => $this->user?->name,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => auth()->user()->id,
        ];
    }
}
