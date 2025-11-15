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
        'banner_image',
        'video',
        'gallery',
        'author',
        'published_date',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_date' => 'date',
        'title' => 'array',
        'content' => 'array',
        'gallery' => 'array',
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

    public function getBannerImageUrlAttribute()
    {
        if (!$this->banner_image) {
            return null;
        }

        if (str_starts_with($this->banner_image, 'assets')) {
            return asset($this->banner_image);
        }
        return asset('storage/' . $this->banner_image);
    }

    public function getVideoUrlAttribute()
    {
        if (!$this->video) {
            return null;
        }

        if (str_starts_with($this->video, 'http')) {
            return $this->video;
        }

        if (str_starts_with($this->video, 'assets')) {
            return asset($this->video);
        }
        return asset('storage/' . $this->video);
    }

    public function getGalleryUrlsAttribute()
    {
        if (!$this->gallery || !is_array($this->gallery)) {
            return [];
        }

        return array_map(function ($image) {
            if (str_starts_with($image, 'assets')) {
                return asset($image);
            }
            return asset('storage/' . $image);
        }, $this->gallery);
    }
}
