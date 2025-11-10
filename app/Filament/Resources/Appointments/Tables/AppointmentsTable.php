<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('doctor.name')
                    ->label('Doctor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('appointment_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('patient_name')
                    ->label('Patient')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('patient_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('patient_phone')
                    ->label('Phone')
                    ->toggleable(),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return ucfirst($state);
                    }),
                TextColumn::make('created_at')
                    ->label('Requested At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
