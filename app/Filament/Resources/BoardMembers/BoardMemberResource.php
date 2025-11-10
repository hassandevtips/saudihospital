<?php

namespace App\Filament\Resources\BoardMembers;

use App\Filament\Resources\BoardMembers\Pages\CreateBoardMember;
use App\Filament\Resources\BoardMembers\Pages\EditBoardMember;
use App\Filament\Resources\BoardMembers\Pages\ListBoardMembers;
use App\Filament\Resources\BoardMembers\Schemas\BoardMemberForm;
use App\Filament\Resources\BoardMembers\Tables\BoardMembersTable;
use App\Models\BoardMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use UnitEnum;

class BoardMemberResource extends Resource
{
    use Translatable;

    protected static ?string $model = BoardMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static UnitEnum|string|null $navigationGroup = 'Hospital Management';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return BoardMemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BoardMembersTable::configure($table);
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
            'index' => ListBoardMembers::route('/'),
            'create' => CreateBoardMember::route('/create'),
            'edit' => EditBoardMember::route('/{record}/edit'),
        ];
    }
}
