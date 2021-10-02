<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->imag ?? '',
            'categories' => CategoryResource::collection( $this->categories()->get()),
            'user_id' => $this->user->id,
            'social_links' => $this->social_link ?? '',
            'slug' => $this->slug ?? ''
        ];
    }

}
