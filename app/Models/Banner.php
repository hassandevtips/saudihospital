<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'button_text'];

    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'button_link',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'title' => 'array',
        'description' => 'array',
        'button_text' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getImageUrlAttribute()
    {
        // If image starts with 'assets', it's from the seeded data
        if (str_starts_with($this->image, 'assets')) {
            return asset($this->image);
        }
        // Otherwise, it's an uploaded file in storage
        return asset('storage/' . $this->image);
    }
}
