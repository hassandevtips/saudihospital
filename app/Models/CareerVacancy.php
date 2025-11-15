<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class CareerVacancy extends Model
{
    use HasTranslations;

    /**
     * @var array<int, string>
     */
    public array $translatable = [
        'title',
        'department',
        'location',
        'summary',
        'description',
        'requirements',
        'employment_type',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'title',
        'department',
        'location',
        'summary',
        'description',
        'requirements',
        'employment_type',
        'is_active',
        'sort_order',
        'posted_at',
        'closing_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'title' => 'array',
        'department' => 'array',
        'location' => 'array',
        'summary' => 'array',
        'description' => 'array',
        'requirements' => 'array',
        'employment_type' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'posted_at' => 'datetime',
        'closing_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (CareerVacancy $vacancy): void {
            if (empty($vacancy->slug) && ! empty($vacancy->title)) {
                $title = is_array($vacancy->title)
                    ? ($vacancy->title[app()->getLocale()] ?? ($vacancy->title['en'] ?? reset($vacancy->title)))
                    : $vacancy->title;

                if (! empty($title)) {
                    $vacancy->slug = Str::slug($title);
                }
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('posted_at');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class);
    }
}
