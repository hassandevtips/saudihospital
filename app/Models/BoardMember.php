<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BoardMember extends Model
{
    use HasTranslations;

    /**
     * The attributes that are translatable.
     *
     * @var array<int, string>
     */
    public $translatable = [
        'name',
        'position',
        'bio',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'position',
        'bio',
        'image',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'pinterest_url',
        'is_active',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'name' => 'array',
        'position' => 'array',
        'bio' => 'array',
    ];

    /**
     * Scope a query to only include active board members ordered by the order column.
     */
    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Get the full URL for the stored image.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'assets')) {
            return asset($this->image);
        }

        return asset('storage/' . ltrim($this->image, '/'));
    }
}
