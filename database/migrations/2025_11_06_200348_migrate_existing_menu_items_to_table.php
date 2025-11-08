<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\MenuItem;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate existing JSON menu items to menu_items table
        // Check if menus table has items column
        if (!Schema::hasColumn('menus', 'items')) {
            return; // Skip if items column doesn't exist
        }

        $menus = DB::table('menus')->get();

        foreach ($menus as $menu) {
            $itemsJson = $menu->items ?? null;

            if (!$itemsJson) {
                continue;
            }

            $items = is_string($itemsJson) ? json_decode($itemsJson, true) : $itemsJson;

            if (!is_array($items) || empty($items)) {
                continue;
            }

            $order = 0;
            foreach ($items as $item) {
                if (!is_array($item)) {
                    continue;
                }

                // Create parent menu item
                $title = $item['title'] ?? '';
                if (is_string($title)) {
                    $title = ['en' => $title];
                } elseif (!is_array($title)) {
                    $title = ['en' => ''];
                }

                $menuItem = MenuItem::create([
                    'menu_id' => $menu->id,
                    'parent_id' => null,
                    'title' => $title,
                    'url' => $item['url'] ?? '#',
                    'blank' => $item['blank'] ?? false,
                    'order' => $order++,
                ]);

                // Create children items
                if (isset($item['children']) && is_array($item['children']) && !empty($item['children'])) {
                    $childOrder = 0;
                    foreach ($item['children'] as $child) {
                        if (!is_array($child)) {
                            continue;
                        }

                        $childTitle = $child['title'] ?? '';
                        if (is_string($childTitle)) {
                            $childTitle = ['en' => $childTitle];
                        } elseif (!is_array($childTitle)) {
                            $childTitle = ['en' => ''];
                        }

                        MenuItem::create([
                            'menu_id' => $menu->id,
                            'parent_id' => $menuItem->id,
                            'title' => $childTitle,
                            'url' => $child['url'] ?? '#',
                            'blank' => $child['blank'] ?? false,
                            'order' => $childOrder++,
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert menu_items back to JSON in menus table
        $menus = Menu::with(['items.children'])->get();

        foreach ($menus as $menu) {
            $items = [];

            foreach ($menu->items()->orderBy('order')->get() as $item) {
                $itemData = [
                    'title' => $item->title, // Already an array
                    'url' => $item->url,
                    'blank' => $item->blank,
                    'children' => [],
                ];

                // Add children
                foreach ($item->children()->orderBy('order')->get() as $child) {
                    $itemData['children'][] = [
                        'title' => $child->title, // Already an array
                        'url' => $child->url,
                        'blank' => $child->blank,
                    ];
                }

                $items[] = $itemData;
            }

            DB::table('menus')
                ->where('id', $menu->id)
                ->update([
                    'items' => json_encode($items),
                ]);
        }

        // Delete all menu items
        DB::table('menu_items')->truncate();
    }
};
