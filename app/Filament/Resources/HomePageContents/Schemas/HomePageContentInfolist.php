<?php

namespace App\Filament\Resources\HomePageContents\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class HomePageContentInfolist
{

    protected static function getIconOptions(): array
    {
        $icons = [];
        for ($i = 1; $i <= 80; $i++) {
            $iconClass = "icon-{$i}";
            // Create a visual preview with the icon
            $icons[$iconClass] = "<div style='display: flex; align-items: center; gap: 10px;'>" .
                "<i class='{$iconClass}' style='font-size: 24px; min-width: 30px;'></i>" .
                "<span style='font-weight: 500;'>{$iconClass}</span>" .
                "</div>";
        }
        return $icons;
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                // About Section
                Section::make('About Section')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('about_image')
                            ->label('About Image')
                            ->columnSpanFull(),

                        TextEntry::make('about_years')
                            ->label('Years of Experience'),

                        TextEntry::make('about_years_text')
                            ->label('Years Text')
                            ->columnSpanFull(),

                        TextEntry::make('about_subtitle')
                            ->label('Subtitle')
                            ->columnSpanFull(),

                        TextEntry::make('about_title')
                            ->label('Title')
                            ->columnSpanFull(),

                        TextEntry::make('about_description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->wrap(),

                        RepeatableEntry::make('key_highlights')
                            ->label('Key Highlights')
                            ->schema([
                                TextEntry::make('item')
                                    ->label('Highlight'),
                            ])
                            ->columnSpanFull(),

                        RepeatableEntry::make('services_offered')
                            ->label('Services Offered')
                            ->schema([
                                TextEntry::make('item')
                                    ->label('Service'),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // Statistics Section
                Section::make('Statistics Section')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('stats_doctors')
                            ->label('Doctors Count'),

                        TextEntry::make('stats_beds')
                            ->label('Beds Count'),

                        TextEntry::make('stats_clinics')
                            ->label('Clinics Count'),

                        TextEntry::make('stats_centers')
                            ->label('Centers Count'),
                    ])
                    ->columnSpanFull(),

                // Tabs Section
                Section::make('Tabs Section')
                    ->columns(2)
                    ->schema([
                        RepeatableEntry::make('tabs')
                            ->label('Tabs')
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Tab Title'),
                                Select::make('icon')
                                    ->label('Icon')
                                    ->required()
                                    ->options(self::getIconOptions())
                                    ->searchable()
                                    ->allowHtml()
                                    ->native(false)
                                    ->placeholder('Select an icon')
                                    ->helperText('Search by icon number (e.g., "icon-17") or scroll to browse all 80 available icons'),
                                TextEntry::make('heading')
                                    ->label('Content Heading'),
                                TextEntry::make('description')
                                    ->label('Description')
                                    ->wrap(),
                                RepeatableEntry::make('list_items')
                                    ->label('List Items')
                                    ->schema([
                                        TextEntry::make('item')
                                            ->label('Item'),
                                    ]),
                                ImageEntry::make('image')
                                    ->label('Tab Image'),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // Pharmacy Section
                Section::make('Pharmacy Section')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('pharmacy_title')
                            ->label('Title')
                            ->columnSpanFull(),

                        TextEntry::make('pharmacy_description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->wrap(),

                        ImageEntry::make('pharmacy_image')
                            ->label('Pharmacy Image')
                            ->columnSpanFull(),

                        RepeatableEntry::make('pharmacy_services')
                            ->label('Pharmacy Services')
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Service Title'),
                                TextEntry::make('description')
                                    ->label('Service Description')
                                    ->wrap(),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // Insurances Section
                Section::make('Insurances Section')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('insurances_title')
                            ->label('Title')
                            ->columnSpanFull(),

                        RepeatableEntry::make('insurance_logos')
                            ->label('Insurance Logos')
                            ->schema([
                                ImageEntry::make('logo')
                                    ->label('Logo'),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // Status
                TextEntry::make('is_active')
                    ->label('Active')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? 'Active' : 'Inactive')
                    ->color(fn($state) => $state ? 'success' : 'danger')
                    ->columnSpanFull(),
            ]);
    }
}
