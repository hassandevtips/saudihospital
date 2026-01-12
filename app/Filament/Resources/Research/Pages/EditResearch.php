<?php

namespace App\Filament\Resources\Research\Pages;

use App\Filament\Resources\Research\ResearchResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditResearch extends EditRecord
{
    use Translatable;

    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Store non-translatable file fields before parent processing
        $video = $data['video'] ?? null;
        $gallery = $data['gallery'] ?? null;

        // Call parent to handle translatable fields
        $data = parent::mutateFormDataBeforeSave($data);

        // Restore non-translatable file fields after translation processing
        // The translatable trait might remove these fields
        if ($video !== null) {
            $data['video'] = $video;
        }

        if ($gallery !== null) {
            $data['gallery'] = $gallery;
        }

        return $data;
    }
}

