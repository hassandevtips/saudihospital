<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'blank',
        'order',
    ];

    public $translatable = ['title'];

    protected $casts = [
        'title' => 'array',
        'blank' => 'boolean',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically set menu_id from parent item if not set
        static::creating(function ($menuItem) {
            if (!$menuItem->menu_id && $menuItem->parent_id) {
                $parent = static::find($menuItem->parent_id);
                if ($parent) {
                    $menuItem->menu_id = $parent->menu_id;
                }
            }
        });

        // Ensure children have the same menu_id as parent
        static::saving(function ($menuItem) {
            if ($menuItem->parent_id && !$menuItem->menu_id) {
                $parent = static::find($menuItem->parent_id);
                if ($parent) {
                    $menuItem->menu_id = $parent->menu_id;
                }
            }
        });
    }

    /**
     * Get the menu that owns this item
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the parent menu item
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Get child menu items
     */
    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }
}
