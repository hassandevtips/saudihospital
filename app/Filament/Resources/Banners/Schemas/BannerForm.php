<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Banner Title')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->label('Banner Image')
                    ->directory('banners')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('button_text')
                    ->label('Button Text')
                    ->maxLength(50),
                TextInput::make('button_link')
                    ->label('Button Link/URL')
                    ->url()
                    ->maxLength(255),
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
