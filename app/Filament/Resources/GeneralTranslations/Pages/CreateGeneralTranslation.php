<?php

namespace App\Filament\Resources\GeneralTranslations\Pages;

use App\Filament\Resources\GeneralTranslations\GeneralTranslationResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateGeneralTranslation extends CreateRecord
{
    use Translatable;

    protected static string $resource = GeneralTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
