<?php

namespace App\Filament\Resources\GeneralTranslations\Pages;

use App\Filament\Resources\GeneralTranslations\GeneralTranslationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListGeneralTranslations extends ListRecords
{
    use Translatable;

    protected static string $resource = GeneralTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
