<?php

namespace App\Filament\Resources\HomePageContents\Pages;

use App\Filament\Resources\HomePageContents\HomePageContentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ViewRecord\Concerns\Translatable;

class ViewHomePageContent extends ViewRecord
{
    use Translatable;

    protected static string $resource = HomePageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            EditAction::make(),
        ];
    }
}
