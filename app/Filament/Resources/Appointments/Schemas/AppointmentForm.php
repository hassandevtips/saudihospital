<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('appointment_date')
                    ->label('Appointment Date')
                    ->required()
                    ->minDate(now()->startOfDay()),
                TimePicker::make('appointment_time')
                    ->label('Appointment Time')
                    ->required()
                    ->seconds(false),
                Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->required()
                    ->label('Doctor')
                    ->searchable()
                    ->preload(),
                TextInput::make('patient_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Patient Name'),
                TextInput::make('patient_email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Patient Email'),
                TextInput::make('patient_phone')
                    ->tel()
                    ->required()
                    ->maxLength(32)
                    ->label('Patient Phone'),
                Textarea::make('message')
                    ->label('Message')
                    ->rows(4)
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
