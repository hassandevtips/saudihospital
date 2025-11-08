<?php

namespace App\Filament\Resources\Menus\Pages;

use App\Filament\Resources\Menus\MenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditMenu extends EditRecord
{
    use Translatable;

    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure items relationship is loaded
        if ($this->record && !$this->record->relationLoaded('items')) {
            $this->record->load('items.children');
        }

        return $data;
    }

    public function updatedActiveLocale(): void
    {
        // When locale changes, refresh the form to show correct translations
        $this->fillForm();
    }

    protected function afterSave(): void
    {
        // Ensure menu_id is set for all items after save
        if ($this->record) {
            // Use the relationship directly, not the accessor
            $this->record->items()->whereNull('menu_id')->update(['menu_id' => $this->record->id]);

            // Get items from relationship (not accessor) to ensure they're model instances
            $items = $this->record->items()->with('children')->get();

            // Ensure menu_id is set for all children and parent_id is correct
            foreach ($items as $item) {
                if ($item instanceof \App\Models\MenuItem) {
                    $item->children()->update([
                        'menu_id' => $this->record->id,
                    ]);
                    // Fix any children with incorrect parent_id
                    $item->children()->where('parent_id', '!=', $item->id)->update([
                        'parent_id' => $item->id,
                    ]);
                }
            }
        }
    }
}
