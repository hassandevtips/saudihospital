<?php

namespace App\Filament\Resources\Clinics\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ClinicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state));
                        }
                    })
                    ->label('Title'),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('Slug')
                    ->helperText('URL-friendly version of the title'),

                Textarea::make('short_description')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull()
                    ->label('Short Description')
                    ->helperText('Brief description shown on the listing page'),

                RichEditor::make('full_description')
                    ->required()
                    ->columnSpanFull()
                    ->label('Full Description')
                    ->helperText('Detailed description shown on the clinic detail page'),

                FileUpload::make('icon_image')
                    ->image()
                    ->disk('public')
                    ->directory('clinics/icons')
                    ->label('Icon Image')
                    ->helperText('Upload an icon/image for this clinic')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->required()
                    ->default(true)
                    ->label('Active'),

                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Display Order')
                    ->helperText('Lower numbers appear first'),
            ]);
    }
}
