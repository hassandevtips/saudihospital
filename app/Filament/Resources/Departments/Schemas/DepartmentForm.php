<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Department Name')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->label('Department Image')
                    ->directory('departments')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
                TextInput::make('order')
                    ->label('Display Order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
            ]);
    }
}
