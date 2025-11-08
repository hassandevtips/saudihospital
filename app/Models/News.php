<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'content'];

    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'published_date',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_date' => 'date',
        'title' => 'array',
        'content' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('published_date', 'desc');
    }

    public function getImageUrlAttribute()
    {
        if (str_starts_with($this->image, 'assets')) {
            return asset($this->image);
        }
        return asset('storage/' . $this->image);
    }
}
