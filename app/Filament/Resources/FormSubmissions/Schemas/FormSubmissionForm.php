<?php

namespace App\Filament\Resources\FormSubmissions\Schemas;

use App\Models\FormSubmission;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FormSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Submission Details')
                    ->schema([
                        Select::make('type')
                            ->label('Form Type')
                            ->options(FormSubmission::getTypes())
                            ->required()
                            ->searchable()
                            ->columnSpan(1),

                        Select::make('status')
                            ->label('Status')
                            ->options(FormSubmission::getStatuses())
                            ->default('pending')
                            ->required()
                            ->columnSpan(1),

                        DateTimePicker::make('submitted_at')
                            ->label('Submission Date')
                            ->default(now())
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Personal Information')
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

                        TextInput::make('national_id')
                            ->label('National ID / Passport')
                            ->maxLength(50),

                        DatePicker::make('date_of_birth')
                            ->label('Date of Birth')
                            ->maxDate(now()->subYears(15)),

                        TextInput::make('current_position')
                            ->label('Current Position / Occupation')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Educational Background')
                    ->schema([
                        Select::make('education_level')
                            ->label('Education Level')
                            ->options([
                                'high_school' => 'High School',
                                'diploma' => 'Diploma',
                                'bachelor' => 'Bachelor\'s Degree',
                                'master' => 'Master\'s Degree',
                                'phd' => 'PhD',
                                'other' => 'Other',
                            ])
                            ->searchable(),

                        TextInput::make('university')
                            ->label('University / Institution')
                            ->maxLength(255),

                        TextInput::make('major')
                            ->label('Major / Field of Study')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Application Materials')
                    ->schema([
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

                        Textarea::make('message')
                            ->label('Additional Message')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Administrative')
                    ->schema([
                        Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(4)
                            ->helperText('Internal notes (not visible to applicant)')
                            ->columnSpanFull(),

                        TextInput::make('ip_address')
                            ->label('IP Address')
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Automatically captured'),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
