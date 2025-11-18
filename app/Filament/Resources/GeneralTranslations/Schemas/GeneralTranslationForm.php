<?php

namespace App\Filament\Resources\GeneralTranslations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GeneralTranslationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Key')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Unique identifier for this translation (e.g., "welcome_message", "footer_text")')
                    ->placeholder('e.g., welcome_message')
                    ->alphaDash()
                    ->columnSpanFull(),
                
                Textarea::make('value')
                    ->label('Text Content')
                    ->required()
                    ->rows(4)
                    ->helperText('The translatable text content')
                    ->columnSpanFull(),
                
                TextInput::make('group')
                    ->label('Group')
                    ->maxLength(255)
                    ->helperText('Optional: Group related translations together (e.g., "header", "footer", "buttons")')
                    ->placeholder('e.g., header')
                    ->columnSpanFull(),
                
                Textarea::make('description')
                    ->label('Description')
                    ->rows(2)
                    ->helperText('Optional: Add context or notes about where this translation is used')
                    ->columnSpanFull(),
                
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
                
                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Lower numbers appear first'),
            ]);
    }
}

