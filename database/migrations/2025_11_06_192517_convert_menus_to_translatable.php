<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Store existing data including items
        $menus = DB::table('menus')->get()->map(function ($menu) {
            return [
                'id' => $menu->id,
                'title' => $menu->title ?? '',
                'items' => $menu->items ?? null,
            ];
        })->toArray();

        // Convert title to JSON
        if (Schema::hasColumn('menus', 'title')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
        Schema::table('menus', function (Blueprint $table) {
            $table->json('title')->after('location');
        });

        // Convert items titles to translatable format and restore data
        foreach ($menus as $menu) {
            $items = null;
            if ($menu['items']) {
                $itemsArray = is_string($menu['items']) ? json_decode($menu['items'], true) : $menu['items'];
                if (is_array($itemsArray)) {
                    $items = $this->convertItemsToTranslatable($itemsArray);
                }
            }

            DB::table('menus')
                ->where('id', $menu['id'])
                ->update([
                    'title' => json_encode(['en' => $menu['title']]),
                    'items' => $items ? json_encode($items) : null,
                ]);
        }
    }

    private function convertItemsToTranslatable(array $items): array
    {
        return array_map(function ($item) {
            // Convert item title to translatable format
            if (isset($item['title']) && is_string($item['title'])) {
                $item['title'] = ['en' => $item['title']];
            }

            // Convert children titles to translatable format
            if (isset($item['children']) && is_array($item['children'])) {
                $item['children'] = array_map(function ($child) {
                    if (isset($child['title']) && is_string($child['title'])) {
                        $child['title'] = ['en' => $child['title']];
                    }
                    return $child;
                }, $item['children']);
            }

            return $item;
        }, $items);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data including items
        $menus = DB::table('menus')->get()->map(function ($menu) {
            $items = null;
            if ($menu->items) {
                $itemsArray = is_string($menu->items) ? json_decode($menu->items, true) : $menu->items;
                if (is_array($itemsArray)) {
                    $items = $this->convertItemsFromTranslatable($itemsArray);
                }
            }

            return [
                'id' => $menu->id,
                'title' => $this->extractFromJson($menu->title),
                'items' => $items,
            ];
        })->toArray();

        // Convert back to string
        if (Schema::hasColumn('menus', 'title')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->dropColumn('title');
            });
            Schema::table('menus', function (Blueprint $table) {
                $table->string('title')->after('location');
            });
        }

        // Restore data
        foreach ($menus as $menu) {
            DB::table('menus')
                ->where('id', $menu['id'])
                ->update([
                    'title' => $menu['title'],
                    'items' => $menu['items'] ? json_encode($menu['items']) : null,
                ]);
        }
    }

    private function convertItemsFromTranslatable(array $items): array
    {
        return array_map(function ($item) {
            // Convert item title from translatable format
            if (isset($item['title']) && is_array($item['title'])) {
                $item['title'] = $this->extractFromJson(json_encode($item['title']));
            }

            // Convert children titles from translatable format
            if (isset($item['children']) && is_array($item['children'])) {
                $item['children'] = array_map(function ($child) {
                    if (isset($child['title']) && is_array($child['title'])) {
                        $child['title'] = $this->extractFromJson(json_encode($child['title']));
                    }
                    return $child;
                }, $item['children']);
            }

            return $item;
        }, $items);
    }

    private function extractFromJson($json): string
    {
        if (empty($json)) return '';
        $decoded = json_decode($json, true);
        if (is_array($decoded)) {
            return $decoded['en'] ?? ($decoded[array_key_first($decoded)] ?? '');
        }
        return '';
    }
};
