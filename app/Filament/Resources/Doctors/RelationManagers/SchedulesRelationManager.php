<?php

namespace App\Filament\Resources\Doctors\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SchedulesRelationManager extends RelationManager
{
    protected static string $relationship = 'schedules';

    protected static ?string $title = 'Doctor Schedule';

    protected static ?string $recordTitleAttribute = 'day_of_week';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('day_of_week')
                    ->label('Day of Week')
                    ->options([
                        'monday' => 'Monday',
                        'tuesday' => 'Tuesday',
                        'wednesday' => 'Wednesday',
                        'thursday' => 'Thursday',
                        'friday' => 'Friday',
                        'saturday' => 'Saturday',
                        'sunday' => 'Sunday',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->searchable(),

                Forms\Components\TimePicker::make('start_time')
                    ->label('Start Time')
                    ->required()
                    ->seconds(false),

                Forms\Components\TimePicker::make('end_time')
                    ->label('End Time')
                    ->required()
                    ->seconds(false)
                    ->after('start_time'),

                Forms\Components\Select::make('slot_duration')
                    ->label('Slot Duration (minutes)')
                    ->options([
                        15 => '15 minutes',
                        20 => '20 minutes',
                        30 => '30 minutes',
                        45 => '45 minutes',
                        60 => '60 minutes',
                    ])
                    ->default(30)
                    ->required()
                    ->helperText('Duration of each appointment slot'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required()
                    ->helperText('Inactive schedules will not show available slots'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('day_of_week')
            ->columns([
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Day')
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('Start Time')
                    ->time('h:i A')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_time')
                    ->label('End Time')
                    ->time('h:i A')
                    ->sortable(),

                Tables\Columns\TextColumn::make('slot_duration')
                    ->label('Slot Duration')
                    ->formatStateUsing(fn(int $state): string => "{$state} min")
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('day_of_week')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only')
                    ->native(false),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
