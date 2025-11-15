<?php

namespace App\Filament\Resources\CareerVacancies\Pages;

use App\Filament\Resources\CareerVacancies\CareerVacancyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditCareerVacancy extends EditRecord
{
    use Translatable;

    protected static string $resource = CareerVacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            DeleteAction::make(),
        ];
    }
}
