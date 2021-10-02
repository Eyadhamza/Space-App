<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use HasFactory,AsSource;

    protected $fillable = [
        'name',
        'description',
        'image',
        'slug'
    ];


    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
