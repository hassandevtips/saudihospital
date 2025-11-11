<?php

namespace App\Filament\Resources\HomePageContents\Pages;

use App\Filament\Resources\HomePageContents\HomePageContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListHomePageContents extends ListRecords
{
    use Translatable;

    protected static string $resource = HomePageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
