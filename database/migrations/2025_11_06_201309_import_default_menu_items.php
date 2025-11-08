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
        // Menu items data to import
        $menuItemsData = [
            ["title" => "Home", "url" => "/", "blank" => false, "children" => []],
            ["title" => "Alsaudi Hospital", "url" => "#", "blank" => false, "children" => [
                ["title" => "Our History", "url" => "our-history", "blank" => false],
                ["title" => "Vision Mission", "url" => "vision-mission", "blank" => false],
                ["title" => "Core Values", "url" => "core-values", "blank" => false],
                ["title" => "Partners & Network", "url" => "partners-network", "blank" => false],
                ["title" => "Board Members", "url" => "board-members", "blank" => false],
                ["title" => "Group Overview", "url" => "group-overview", "blank" => false],
                ["title" => "Laboratory", "url" => "laboratory", "blank" => false],
                ["title" => "Pharmacies", "url" => "pharmacies", "blank" => false],
                ["title" => "Nursing", "url" => "nursing", "blank" => false],
                ["title" => "Patient Relations", "url" => "patient-relations", "blank" => false],
                ["title" => "Medical Tourism", "url" => "medical-tourism", "blank" => false],
                ["title" => "Accessibility for Persons with Disabilities", "url" => "accessibility-for-persons-with-disabilities", "blank" => false],
            ]],
            ["title" => "Centers of Excellence", "url" => "#", "blank" => false, "children" => [
                ["title" => "Cardiology & Heart Care", "url" => "cardiology-heart-care", "blank" => false],
                ["title" => "Maternity & Women's Health", "url" => "maternity-womens-health", "blank" => false],
                ["title" => "ENT Unit", "url" => "ent-unit", "blank" => false],
                ["title" => "Gastroenterology & Hepatology", "url" => "gastroenterology-hepatology", "blank" => false],
                ["title" => "Orthopedics & Sport Injuries", "url" => "orthopedics-sport-injuries", "blank" => false],
                ["title" => "Interventional Radiology", "url" => "interventional-radiology", "blank" => false],
                ["title" => "Hemodialysis Center", "url" => "hemodialysis-center", "blank" => false],
                ["title" => "Dental & Maxillofacial Center", "url" => "dental-maxillofacial-center", "blank" => false],
            ]],
            ["title" => "Find A Doctors", "url" => "doctors", "blank" => false, "children" => []],
            ["title" => "News & Events", "url" => "news", "blank" => false, "children" => []],
            ["title" => "Contact Us", "url" => "contact-us", "blank" => false, "children" => []],
        ];

        // Find or create the header menu
        $menu = Menu::where('key', 'header')->first();

        if (!$menu) {
            // Create the menu if it doesn't exist
            $menu = Menu::create([
                'key' => 'header',
                'location' => 'header',
                'title' => ['en' => 'Header Menu', 'ar' => 'قائمة الهيدر'],
                'activated' => true,
            ]);
        }

        // Clear existing menu items for this menu
        MenuItem::where('menu_id', $menu->id)->delete();

        // Import menu items
        $order = 0;
        foreach ($menuItemsData as $itemData) {
            // Convert title to translatable format with both EN and AR
            $titleText = is_string($itemData['title']) ? $itemData['title'] : ($itemData['title']['en'] ?? '');
            $title = ['en' => $titleText, 'ar' => $titleText];

            // Create parent menu item
            $menuItem = MenuItem::create([
                'menu_id' => $menu->id,
                'parent_id' => null,
                'title' => $title,
                'url' => $itemData['url'] ?? '#',
                'blank' => $itemData['blank'] ?? false,
                'order' => $order++,
            ]);

            // Create children items
            if (isset($itemData['children']) && is_array($itemData['children']) && !empty($itemData['children'])) {
                $childOrder = 0;
                foreach ($itemData['children'] as $childData) {
                    // Convert child title to translatable format with both EN and AR
                    $childTitleText = is_string($childData['title']) ? $childData['title'] : ($childData['title']['en'] ?? '');
                    $childTitle = ['en' => $childTitleText, 'ar' => $childTitleText];

                    MenuItem::create([
                        'menu_id' => $menu->id,
                        'parent_id' => $menuItem->id,
                        'title' => $childTitle,
                        'url' => $childData['url'] ?? '#',
                        'blank' => $childData['blank'] ?? false,
                        'order' => $childOrder++,
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Find the header menu
        $menu = Menu::where('key', 'header')->first();

        if ($menu) {
            // Delete all menu items for this menu
            MenuItem::where('menu_id', $menu->id)->delete();
        }
    }
};
