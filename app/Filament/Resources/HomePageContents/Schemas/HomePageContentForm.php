<?php

namespace App\Filament\Resources\HomePageContents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HomePageContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                // About Section
                Placeholder::make('about_section_label')
                    ->label('About Section')
                    ->content('')
                    ->columnSpanFull(),

                FileUpload::make('about_image')
                    ->label('About Image')
                    ->image()
                    ->directory('home-page')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('about_years')
                    ->label('Years of Experience')
                    ->numeric()
                    ->default(10)
                    ->required(),
                TextInput::make('about_years_text')
                    ->label('Years Text (e.g., "Years of Experience in This Field")')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('about_subtitle')
                    ->label('Subtitle (e.g., "Who We Are?")')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('about_title')
                    ->label('Title')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('about_description')
                    ->label('Description')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('key_highlights')
                    ->label('Key Highlights')
                    ->schema([
                        TextInput::make('item')
                            ->label('Highlight')
                            ->required(),
                    ])
                    ->defaultItems(4)
                    ->columnSpanFull(),
                Repeater::make('services_offered')
                    ->label('Services Offered')
                    ->schema([
                        TextInput::make('item')
                            ->label('Service')
                            ->required(),
                    ])
                    ->defaultItems(4)
                    ->columnSpanFull(),

                // Statistics Section
                Placeholder::make('stats_section_label')
                    ->label('Statistics Section')
                    ->content('')
                    ->columnSpanFull(),

                TextInput::make('stats_doctors')
                    ->label('Doctors Count')
                    ->numeric()
                    ->default(100)
                    ->required(),
                TextInput::make('stats_beds')
                    ->label('Beds Count')
                    ->numeric()
                    ->default(120)
                    ->required(),
                TextInput::make('stats_clinics')
                    ->label('Clinics Count')
                    ->numeric()
                    ->default(20)
                    ->required(),
                TextInput::make('stats_centers')
                    ->label('Centers Count')
                    ->numeric()
                    ->default(5)
                    ->required(),

                // Tabs Section
                Placeholder::make('tabs_section_label')
                    ->label('Tabs Section')
                    ->content('')
                    ->columnSpanFull(),

                Repeater::make('tabs')
                    ->label('Tabs')
                    ->schema([
                        TextInput::make('title')
                            ->label('Tab Title')
                            ->required()
                            ->placeholder('e.g., Patient Relations'),
                        TextInput::make('icon')
                            ->label('Icon Class')
                            ->required()
                            ->placeholder('e.g., icon-17')
                            ->helperText('Icon class from your theme (e.g., icon-17, icon-18, etc.)'),
                        TextInput::make('heading')
                            ->label('Content Heading')
                            ->required()
                            ->placeholder('e.g., Patient Relations'),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->required(),
                        Repeater::make('list_items')
                            ->label('List Items')
                            ->schema([
                                TextInput::make('item')
                                    ->label('Item')
                                    ->required(),
                            ])
                            ->defaultItems(3)
                            ->collapsible(),
                        FileUpload::make('image')
                            ->label('Tab Image')
                            ->image()
                            ->directory('home-page/tabs')
                            ->disk('public')
                            ->imageEditor(),
                    ])
                    ->defaultItems(1)
                    ->collapsible()
                    ->columnSpanFull(),

                // Pharmacy Section
                Placeholder::make('pharmacy_section_label')
                    ->label('Pharmacy Section')
                    ->content('')
                    ->columnSpanFull(),

                TextInput::make('pharmacy_title')
                    ->label('Title')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('pharmacy_description')
                    ->label('Description')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('pharmacy_image')
                    ->label('Pharmacy Image')
                    ->image()
                    ->directory('home-page')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                Repeater::make('pharmacy_services')
                    ->label('Pharmacy Services')
                    ->schema([
                        TextInput::make('title')
                            ->label('Service Title')
                            ->required(),
                        Textarea::make('description')
                            ->label('Service Description')
                            ->rows(2),
                    ])
                    ->columnSpanFull(),

                // Insurances Section
                Placeholder::make('insurances_section_label')
                    ->label('Insurances Section')
                    ->content('')
                    ->columnSpanFull(),

                TextInput::make('insurances_title')
                    ->label('Title')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('insurance_logos')
                    ->label('Insurance Logos')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Image')
                            ->image()
                            ->directory('home-page/insurances')
                            ->disk('public')
                            ->imageEditor()
                            ->required(),
                    ])
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
