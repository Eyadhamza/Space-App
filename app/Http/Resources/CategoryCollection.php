<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

/** @see \App\Models\Category */
class CategoryCollection extends ResourceCollection
{
    public function toArray( $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
