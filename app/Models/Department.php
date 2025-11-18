<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Department extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'image',
        'thumbnail_image',
        'banner_image',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
        'description' => 'array',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
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

    public function getThumbnailImageUrlAttribute()
    {
        if (!$this->thumbnail_image) {
            return null;
        }

        if (str_starts_with($this->thumbnail_image, 'assets')) {
            return asset($this->thumbnail_image);
        }
        return asset('storage/' . $this->thumbnail_image);
    }
}
