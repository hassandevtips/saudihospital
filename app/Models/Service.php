<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'image',
        'icon_class',
        'link',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'title' => 'array',
        'description' => 'array',
    ];

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
}
