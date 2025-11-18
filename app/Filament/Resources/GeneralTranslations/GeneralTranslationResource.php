<?php

namespace App\Filament\Resources\GeneralTranslations;

use App\Filament\Resources\GeneralTranslations\Pages\CreateGeneralTranslation;
use App\Filament\Resources\GeneralTranslations\Pages\EditGeneralTranslation;
use App\Filament\Resources\GeneralTranslations\Pages\ListGeneralTranslations;
use App\Filament\Resources\GeneralTranslations\Schemas\GeneralTranslationForm;
use App\Filament\Resources\GeneralTranslations\Tables\GeneralTranslationsTable;
use App\Models\GeneralTranslation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class GeneralTranslationResource extends Resource
{
    use Translatable;

    protected static ?string $model = GeneralTranslation::class;

    protected static ?string $navigationLabel = 'General Translations';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-language';

    protected static ?int $navigationSort = 101;

    protected static UnitEnum|string|null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return GeneralTranslationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GeneralTranslationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGeneralTranslations::route('/'),
            'create' => CreateGeneralTranslation::route('/create'),
            'edit' => EditGeneralTranslation::route('/{record}/edit'),
        ];
    }
}
