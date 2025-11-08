<?php

namespace App\Filament\Resources\Languages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required()
                    ->maxLength(10)
                    ->label('Language Code')
                    ->unique(ignoreRecord: true)
                    ->helperText('e.g., en, ar, fr')
                    ->columnSpan(1),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Language Name')
                    ->helperText('e.g., English, Arabic')
                    ->columnSpan(1),

                TextInput::make('native_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Native Name')
                    ->helperText('e.g., English, العربية')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->helperText('Only active languages will be available for translation')
                    ->columnSpan(1),

                Toggle::make('is_default')
                    ->label('Default Language')
                    ->default(false)
                    ->helperText('Set as the default language for the application')
                    ->columnSpan(1),

                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first')
                    ->columnSpan(1),
            ]);
    }
}
