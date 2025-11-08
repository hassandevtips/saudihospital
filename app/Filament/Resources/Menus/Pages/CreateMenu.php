<?php

namespace App\Filament\Resources\Menus\Pages;

use App\Filament\Resources\Menus\MenuResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateMenu extends CreateRecord
{
    use Translatable;

    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    public function updatedActiveLocale(): void
    {
        // When locale changes, refresh the form to show correct translations
        // For new records, we just need to trigger a re-render
    }

    protected function afterCreate(): void
    {
        // After menu is created, ensure all items have the correct menu_id
        if ($this->record) {
            // Use the relationship directly, not the accessor
            $this->record->items()->whereNull('menu_id')->update(['menu_id' => $this->record->id]);

            // Get items from relationship (not accessor) to ensure they're model instances
            $items = $this->record->items()->with('children')->get();

            // Ensure menu_id is set for all children
            foreach ($items as $item) {
                if ($item instanceof \App\Models\MenuItem) {
                    $item->children()->update([
                        'menu_id' => $this->record->id,
                    ]);
                }
            }
        }
    }
}
