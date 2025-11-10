<?php

namespace App\Filament\Resources\HomePageContents\Pages;

use App\Filament\Resources\HomePageContents\HomePageContentResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateHomePageContent extends CreateRecord
{
    use Translatable;

    protected static string $resource = HomePageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
