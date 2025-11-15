<?php

namespace App\Filament\Resources\CareerVacancies\Pages;

use App\Filament\Resources\CareerVacancies\CareerVacancyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListCareerVacancies extends ListRecords
{
    use Translatable;

    protected static string $resource = CareerVacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
