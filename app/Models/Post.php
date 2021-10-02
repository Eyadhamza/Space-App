<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
        'social_links',
        'slug'
    ];

    protected $casts = [
        'social_links' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->select(['id','name','avatar']);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function scopeOfPopular($query)
    {
        return $query->with('categories')->latest()->limit(3)->get();
    }
}
