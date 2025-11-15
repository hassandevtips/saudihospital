<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\{Section, Grid};
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Location Name')
                            ->columnSpanFull(),

                        Textarea::make('address')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull()
                            ->label('Address'),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull()
                            ->label('Description')
                            ->helperText('Optional description about this location'),
                    ])
                    ->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('phone')
                            ->tel()
                            ->label('Phone Number'),

                        TextInput::make('email')
                            ->email()
                            ->label('Email Address'),

                        FileUpload::make('marker_icon')
                            ->label('Map Marker Icon')
                            ->image()
                            ->disk('public')
                            ->directory('locations/markers')
                            ->visibility('public')
                            ->helperText('Upload a custom icon for this location on the map (PNG/JPG, recommended size: 64x64px)')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Map Coordinates')
                    ->description('Enter the latitude and longitude for this location. You can get these from Google Maps.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('latitude')
                                    ->required()
                                    ->numeric()
                                    ->step(0.0000001)
                                    ->label('Latitude')
                                    ->helperText('Example: 31.9539')
                                    ->placeholder('31.9539'),

                                TextInput::make('longitude')
                                    ->required()
                                    ->numeric()
                                    ->step(0.0000001)
                                    ->label('Longitude')
                                    ->helperText('Example: 35.9106')
                                    ->placeholder('35.9106'),
                            ]),
                    ]),

                Section::make('Working Hours')
                    ->description('Set the working hours for each day of the week')
                    ->schema([
                        Repeater::make('working_hours')
                            ->schema([
                                Select::make('day')
                                    ->required()
                                    ->options([
                                        'monday' => 'Monday',
                                        'tuesday' => 'Tuesday',
                                        'wednesday' => 'Wednesday',
                                        'thursday' => 'Thursday',
                                        'friday' => 'Friday',
                                        'saturday' => 'Saturday',
                                        'sunday' => 'Sunday',
                                    ])
                                    ->label('Day')
                                    ->distinct()
                                    ->columnSpan(2),

                                Toggle::make('is_open')
                                    ->label('Open')
                                    ->default(true)
                                    ->live()
                                    ->columnSpan(1),

                                TimePicker::make('open_time')
                                    ->label('Opening Time')
                                    ->seconds(false)
                                    ->visible(fn($get) => $get('is_open'))
                                    ->required(fn($get) => $get('is_open'))
                                    ->columnSpan(1),

                                TimePicker::make('close_time')
                                    ->label('Closing Time')
                                    ->seconds(false)
                                    ->visible(fn($get) => $get('is_open'))
                                    ->required(fn($get) => $get('is_open'))
                                    ->columnSpan(1),
                            ])
                            ->columns(5)
                            ->defaultItems(7)
                            ->default([
                                ['day' => 'monday', 'is_open' => true, 'open_time' => '08:00', 'close_time' => '17:00'],
                                ['day' => 'tuesday', 'is_open' => true, 'open_time' => '08:00', 'close_time' => '17:00'],
                                ['day' => 'wednesday', 'is_open' => true, 'open_time' => '08:00', 'close_time' => '17:00'],
                                ['day' => 'thursday', 'is_open' => true, 'open_time' => '08:00', 'close_time' => '17:00'],
                                ['day' => 'friday', 'is_open' => false],
                                ['day' => 'saturday', 'is_open' => true, 'open_time' => '08:00', 'close_time' => '17:00'],
                                ['day' => 'sunday', 'is_open' => true, 'open_time' => '08:00', 'close_time' => '17:00'],
                            ])
                            ->addActionLabel('Add Day')
                            ->reorderable(false)
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Display Settings')
                    ->schema([
                        Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->label('Active')
                            ->helperText('Show this location on the map'),

                        TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label('Display Order')
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(2),
            ]);
    }
}
