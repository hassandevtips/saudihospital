<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use TomatoPHP\FilamentMenus\Models\Menu as BaseMenu;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends BaseMenu
{
    use HasTranslations;

    public $translatable = ['title'];

    protected $casts = [
        'title' => 'array',
    ];

    /**
     * Get menu items relationship
     */
    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('order');
    }

    /**
     * Get all menu items (including nested)
     */
    public function allItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    /**
     * Backward compatibility: Get items as array (for frontend)
     * This converts the relationship to the old JSON structure format
     *
     * Note: This accessor is bypassed when accessing via ->items() relationship method
     */
    public function getItemsAttribute($value)
    {
        // Never use accessor in admin panel - always use relationship
        if (request() && request()->is('admin/*')) {
            // Return the relationship value directly (model instances, not array)
            if ($this->relationLoaded('items')) {
                return $this->getRelationValue('items');
            }
            // If relationship not loaded, return null to use relationship method instead
            return null;
        }

        // Check if we have the relationship loaded (new structure)
        if ($this->relationLoaded('items')) {
            // For frontend, return translated items as array structure
            return $this->getTranslatedItemsForFrontend();
        }

        // Fallback: Check if old JSON items column exists (for backward compatibility during migration)
        $rawItems = $this->getAttributes()['items'] ?? null;
        if ($rawItems !== null) {
            if (is_string($rawItems)) {
                $rawItems = json_decode($rawItems, true);
            }
            return is_array($rawItems) ? $rawItems : [];
        }

        // Return empty array if no items (frontend only)
        return [];
    }

    /**
     * Get translated items for frontend display
     */
    protected function getTranslatedItemsForFrontend(): array
    {
        // Always use current locale from app
        $locale = app()->getLocale();

        // Get items relationship (already loaded or load it)
        // Force reload to ensure we get fresh data with current locale
        $items = $this->relationLoaded('items')
            ? $this->getRelationValue('items')
            : $this->items()->with('children')->get();

        return $items->map(function ($item) use ($locale) {
            // Get translated title with fallback
            $title = $this->getTranslatedTitle($item, $locale);

            // Get children with translations
            $children = [];
            if ($item->relationLoaded('children') && $item->children->isNotEmpty()) {
                $children = $item->children->map(function ($child) use ($locale) {
                    $childTitle = $this->getTranslatedTitle($child, $locale);

                    return [
                        'title' => $childTitle,
                        'url' => $this->ensureLocaleUrl($child->url),
                        'blank' => $child->blank,
                    ];
                })->toArray();
            }

            return [
                'title' => $title,
                'url' => $this->ensureLocaleUrl($item->url),
                'blank' => $item->blank,
                'children' => $children,
            ];
        })->toArray();
    }

    /**
     * Get translated title with fallback
     * Always returns a string, never an array
     */
    protected function getTranslatedTitle($item, $locale): string
    {
        // Initialize titleData variable
        $titleData = null;

        // Try to get raw attribute first (before casts/accessors)
        $attributes = $item->getAttributes();
        $rawTitle = $attributes['title'] ?? null;

        // Handle different formats of title data
        if ($rawTitle !== null) {
            if (is_string($rawTitle)) {
                // If it's a JSON string, decode it
                $decoded = json_decode($rawTitle, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $titleData = $decoded;
                } else {
                    // Plain string - return directly
                    return trim((string) $rawTitle);
                }
            } elseif (is_array($rawTitle)) {
                // Already an array (might be from cast)
                $titleData = $rawTitle;
            }
        }

        // If we still don't have titleData, try accessing via attribute (with cast)
        if ($titleData === null) {
            try {
                $titleAttribute = $item->title;

                // If it's already a string (Spatie might have translated it), return it
                if (is_string($titleAttribute)) {
                    return trim($titleAttribute);
                }

                // If it's an array, use it
                if (is_array($titleAttribute)) {
                    $titleData = $titleAttribute;
                }
            } catch (\Exception $e) {
                // If accessing title fails, return empty string
                return '';
            }
        }

        // If we still don't have titleData, return empty string
        if (!is_array($titleData) || empty($titleData)) {
            return '';
        }

        // Now extract the locale-specific title from the array
        $title = null;

        // Try current locale first
        if (isset($titleData[$locale]) && $titleData[$locale] !== null && $titleData[$locale] !== '') {
            $title = $titleData[$locale];
        }
        // Fallback to English
        elseif (isset($titleData['en']) && $titleData['en'] !== null && $titleData['en'] !== '') {
            $title = $titleData['en'];
        }
        // Fallback to first available non-empty, non-array value
        else {
            foreach ($titleData as $value) {
                if ($value !== null && $value !== '' && !is_array($value)) {
                    $title = $value;
                    break;
                }
            }
        }

        // If we still don't have a title, return empty string
        if ($title === null || $title === '') {
            return '';
        }

        // Final safety check: if title is still an array (shouldn't happen), flatten it
        if (is_array($title)) {
            $flatTitle = '';
            array_walk_recursive($title, function ($value) use (&$flatTitle) {
                if (is_string($value) && $value !== '' && $flatTitle === '') {
                    $flatTitle = $value;
                }
            });
            return $flatTitle !== '' ? trim($flatTitle) : '';
        }

        // Convert to string and return (with type safety)
        $result = (string) $title;
        return trim($result);
    }

    /**
     * Ensure URL maintains locale context
     * Since we're using session-based locale, we don't need to modify URLs
     * But we ensure absolute URLs work correctly
     */
    protected function ensureLocaleUrl($url): string
    {
        if (empty($url) || $url === '#') {
            return $url;
        }

        // If it's an absolute URL (http/https), return as is
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }

        // For relative URLs, ensure they start with /
        if (!str_starts_with($url, '/')) {
            $url = '/' . $url;
        }

        return $url;
    }
}
