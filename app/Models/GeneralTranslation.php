<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GeneralTranslation extends Model
{
    use HasTranslations;

    /**
     * The attributes that are translatable.
     *
     * @var array<int, string>
     */
    public $translatable = [
        'value',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'description',
        'is_active',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope a query to only include active translations ordered by position.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Scope a query to filter by group.
     */
    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Get a translation by key.
     *
     * @param string $key
     * @param string|null $locale
     * @param string|null $default
     * @return string|null
     */
    public static function get(string $key, ?string $locale = null, ?string $default = null): ?string
    {
        $locale = $locale ?? app()->getLocale();

        $translation = static::where('key', $key)
            ->where('is_active', true)
            ->first();

        if (!$translation) {
            return $default;
        }

        return $translation->getTranslation('value', $locale, false) ?? $default;
    }

    /**
     * Get all translations by group.
     *
     * @param string $group
     * @param string|null $locale
     * @return array
     */
    public static function getByGroup(string $group, ?string $locale = null): array
    {
        $locale = $locale ?? app()->getLocale();

        $translations = static::where('group', $group)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $result = [];
        foreach ($translations as $translation) {
            $result[$translation->key] = $translation->getTranslation('value', $locale, false);
        }

        return $result;
    }
}
