<?php

namespace App\Filament\Resources\Research\Pages;

use App\Filament\Resources\Research\ResearchResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateResearch extends CreateRecord
{
    use Translatable;

    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store non-translatable file fields before parent processing
        $video = $data['video'] ?? null;
        $gallery = $data['gallery'] ?? null;
        
        // Call parent to handle translatable fields
        $data = parent::mutateFormDataBeforeCreate($data);
        
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

