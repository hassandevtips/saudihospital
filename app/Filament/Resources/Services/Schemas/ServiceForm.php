<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class ServiceForm
{
    protected static function getIconOptions(): array
    {
        $icons = [];
        for ($i = 1; $i <= 59; $i++) {
            $iconClass = "icon-{$i}";
            // Create a visual preview with the icon
            $icons[$iconClass] = "<div style='display: flex; align-items: center; gap: 10px;'>" . "<i class='{$iconClass}' style='font-size: 24px; min-width: 30px;'></i>" . "<span style='font-weight: 500;'>{$iconClass}</span>" . "</div>";
        }
        return $icons;
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public'),


                Select::make('icon_class')
                    ->label('Icon (Select from library)')
                    ->options(self::getIconOptions())
                    ->searchable()
                    ->allowHtml()
                    ->native(false)
                    ->placeholder('Select an icon')
                    ->helperText('Search by icon number (e.g., "icon-17") or scroll to browse all 59 available icons. Or upload a custom icon below.'),

                FileUpload::make('icon_image')
                    ->label('Custom Icon (Upload)')
                    ->directory('services/icons')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->helperText('Optional: Upload a custom icon image. This will be used instead of the icon class if provided.')
                    ->columnSpanFull(),

                TextInput::make('link'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
