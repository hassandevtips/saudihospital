<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'content', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'title' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'meta_keywords' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeTemplate($query, $template)
    {
        return $query->where('template', $template);
    }

    public function getFeaturedImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }

        if (str_starts_with($this->featured_image, 'assets')) {
            return asset($this->featured_image);
        }
        return asset('storage/' . $this->featured_image);
    }

    // Auto-generate slug from title if not provided
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($page) {
            if (empty($page->slug) && !empty($page->title)) {
                // Get title from current locale or first available locale
                $title = is_array($page->title)
                    ? ($page->title[app()->getLocale()] ?? ($page->title['en'] ?? reset($page->title)))
                    : $page->title;

                if (!empty($title)) {
                    $page->slug = \Illuminate\Support\Str::slug($title);
                }
            }
        });
    }

    // Available template options
    public static function getTemplates()
    {
        return [
            'default' => 'Default Template',
            'department-template' => 'Department Template',
            'home' => 'Home Page',
            'contact' => 'Contact Page',
        ];
    }
}
