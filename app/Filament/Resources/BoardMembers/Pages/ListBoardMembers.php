<?php

namespace App\Filament\Resources\BoardMembers\Pages;

use App\Filament\Resources\BoardMembers\BoardMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListBoardMembers extends ListRecords
{
    use Translatable;

    protected static string $resource = BoardMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }
}
