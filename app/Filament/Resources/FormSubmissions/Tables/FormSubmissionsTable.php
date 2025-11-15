<?php

namespace App\Filament\Resources\FormSubmissions\Tables;

use App\Models\FormSubmission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FormSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn($state) => FormSubmission::getTypes()[$state] ?? $state)
                    ->color(fn($state) => match ($state) {
                        'internship' => 'info',
                        'training' => 'success',
                        'volunteer' => 'warning',
                        'research' => 'purple',
                        'fellowship' => 'indigo',
                        'shadowing' => 'pink',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Applicant Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copied!')
                    ->icon('heroicon-o-envelope')
                    ->toggleable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('education_level')
                    ->label('Education')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'high_school' => 'High School',
                        'diploma' => 'Diploma',
                        'bachelor' => 'Bachelor\'s',
                        'master' => 'Master\'s',
                        'phd' => 'PhD',
                        'other' => 'Other',
                        default => $state,
                    })
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('university')
                    ->label('University')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('major')
                    ->label('Major')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => FormSubmission::getStatuses()[$state] ?? $state)
                    ->color(fn($record) => $record->getStatusColor())
                    ->sortable(),

                TextColumn::make('resume_url')
                    ->label('Resume')
                    ->url(fn($record) => $record->resume_url)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-text')
                    ->limit(20)
                    ->toggleable(),

                TextColumn::make('submitted_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->description(fn($record) => $record->submitted_at->format('M d, Y')),

                TextColumn::make('ip_address')
                    ->label('IP')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Form Type')
                    ->options(FormSubmission::getTypes())
                    ->multiple(),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options(FormSubmission::getStatuses())
                    ->multiple(),

                SelectFilter::make('education_level')
                    ->label('Education Level')
                    ->options([
                        'high_school' => 'High School',
                        'diploma' => 'Diploma',
                        'bachelor' => 'Bachelor\'s Degree',
                        'master' => 'Master\'s Degree',
                        'phd' => 'PhD',
                        'other' => 'Other',
                    ])
                    ->multiple(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('submitted_at', 'desc');
    }
}
