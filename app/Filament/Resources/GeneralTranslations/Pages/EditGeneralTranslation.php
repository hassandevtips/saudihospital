<?php

namespace App\Filament\Resources\GeneralTranslations\Pages;

use App\Filament\Resources\GeneralTranslations\GeneralTranslationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditGeneralTranslation extends EditRecord
{
    use Translatable;

    protected static string $resource = GeneralTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            DeleteAction::make(),
        ];
    }
}
