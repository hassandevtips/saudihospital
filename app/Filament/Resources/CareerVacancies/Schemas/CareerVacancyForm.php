<?php

namespace App\Filament\Resources\CareerVacancies\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CareerVacancyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Job Title')
                            ->columnSpanFull()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->label('URL Slug')
                            ->unique(ignoreRecord: true)
                            ->helperText('Auto-generated from title')
                            ->columnSpanFull(),

                        TextInput::make('department')
                            ->label('Department')
                            ->maxLength(255)
                            ->helperText('e.g., Cardiology, Nursing, Administration'),

                        TextInput::make('location')
                            ->label('Location')
                            ->maxLength(255)
                            ->helperText('e.g., Main Hospital, Outpatient Clinic'),

                        TextInput::make('employment_type')
                            ->label('Employment Type')
                            ->maxLength(255)
                            ->helperText('e.g., Full-time, Part-time, Contract')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Job Details')
                    ->schema([
                        Textarea::make('summary')
                            ->label('Job Summary')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Brief overview of the position')
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Job Description')
                            ->rows(5)
                            ->helperText('Detailed description of responsibilities and duties')
                            ->columnSpanFull(),

                        Textarea::make('requirements')
                            ->label('Requirements')
                            ->rows(5)
                            ->helperText('Enter each requirement on a new line')
                            ->columnSpanFull(),
                    ]),

                Section::make('Settings')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Only active vacancies will be visible on the website')
                            ->required(),

                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),

                        DateTimePicker::make('posted_at')
                            ->label('Posted Date')
                            ->default(now())
                            ->helperText('When this vacancy was posted'),

                        DateTimePicker::make('closing_at')
                            ->label('Closing Date')
                            ->helperText('Last date to accept applications'),
                    ])
                    ->columns(2),
            ]);
    }
}
