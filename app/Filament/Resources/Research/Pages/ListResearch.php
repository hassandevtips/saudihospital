<?php

namespace App\Filament\Resources\Research\Pages;

use App\Filament\Resources\Research\ResearchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class ListResearch extends ListRecords
{
    use Translatable;
    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}

