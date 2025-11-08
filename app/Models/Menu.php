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
        // Get items relationship (already loaded or load it)
        $items = $this->relationLoaded('items')
            ? $this->getRelationValue('items')
            : $this->items()->with('children')->get();

        $locale = app()->getLocale();

        return $items->map(function ($item) use ($locale) {
            // Get translated title
            $title = $item->getTranslation('title', $locale, false);
            if (!$title && $item->title) {
                if (is_array($item->title)) {
                    $title = $item->title[$locale]
                        ?? $item->title['en']
                        ?? ($item->title[array_key_first($item->title)] ?? '');
                } else {
                    $title = $item->title;
                }
            }

            // Get children
            $children = [];
            if ($item->relationLoaded('children')) {
                $children = $item->children->map(function ($child) use ($locale) {
                    $childTitle = $child->getTranslation('title', $locale, false);
                    if (!$childTitle && $child->title) {
                        if (is_array($child->title)) {
                            $childTitle = $child->title[$locale]
                                ?? $child->title['en']
                                ?? ($child->title[array_key_first($child->title)] ?? '');
                        } else {
                            $childTitle = $child->title;
                        }
                    }

                    return [
                        'title' => $childTitle,
                        'url' => $child->url,
                        'blank' => $child->blank,
                    ];
                })->toArray();
            }

            return [
                'title' => $title,
                'url' => $item->url,
                'blank' => $item->blank,
                'children' => $children,
            ];
        })->toArray();
    }
}
