<?php

namespace App\Filament\Resources\CareerVacancies;

use App\Filament\Resources\CareerVacancies\Pages\CreateCareerVacancy;
use App\Filament\Resources\CareerVacancies\Pages\EditCareerVacancy;
use App\Filament\Resources\CareerVacancies\Pages\ListCareerVacancies;
use App\Filament\Resources\CareerVacancies\Schemas\CareerVacancyForm;
use App\Filament\Resources\CareerVacancies\Tables\CareerVacanciesTable;
use App\Models\CareerVacancy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class CareerVacancyResource extends Resource
{
    use Translatable;

    protected static ?string $model = CareerVacancy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?string $navigationLabel = 'Career Vacancies';

    protected static ?string $modelLabel = 'Vacancy';

    protected static ?string $pluralModelLabel = 'Vacancies';

    protected static UnitEnum|string|null $navigationGroup = 'Career Management';

    protected static ?int $navigationSort = 20;

    public static function form(Schema $schema): Schema
    {
        return CareerVacancyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CareerVacanciesTable::configure($table);
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
            'index' => ListCareerVacancies::route('/'),
            'create' => CreateCareerVacancy::route('/create'),
            'edit' => EditCareerVacancy::route('/{record}/edit'),
        ];
    }
}
