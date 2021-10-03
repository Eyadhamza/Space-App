<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/** @mixin \App\Models\Category */
class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name'  => $this->name,
            'description' => $this->description ?? '',
            'image' => $this->image ?? '',
            'posts' => PostResource::collection($this->whenLoaded('posts'))
        ];
    }
}
