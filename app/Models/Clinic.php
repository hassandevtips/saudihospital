<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Clinic extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'short_description', 'full_description'];

    protected $fillable = [
        'title',
        'short_description',
        'full_description',
        'icon_image',
        'slug',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'title' => 'array',
        'short_description' => 'array',
        'full_description' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function getIconImageUrlAttribute()
    {
        if (!$this->icon_image) {
            return null;
        }

        if (str_starts_with($this->icon_image, 'assets')) {
            return asset($this->icon_image);
        }
        return asset('storage/' . $this->icon_image);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
