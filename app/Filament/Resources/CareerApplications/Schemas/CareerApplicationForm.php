<?php

namespace App\Filament\Resources\CareerApplications\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CareerApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Application Details')
                    ->schema([
                        Select::make('career_vacancy_id')
                            ->label('Vacancy')
                            ->relationship('vacancy', 'title')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),

                        DateTimePicker::make('submitted_at')
                            ->label('Submission Date')
                            ->default(now())
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Applicant Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(50),

                        TextInput::make('current_position')
                            ->label('Current Position')
                            ->maxLength(255),

                        TextInput::make('resume_url')
                            ->label('Resume/CV URL')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Link to online resume or portfolio')
                            ->columnSpanFull(),

                        Textarea::make('cover_letter')
                            ->label('Cover Letter')
                            ->rows(5)
                            ->columnSpanFull(),

                        TextInput::make('ip_address')
                            ->label('IP Address')
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Automatically captured'),
                    ])
                    ->columns(2),
            ]);
    }
}
