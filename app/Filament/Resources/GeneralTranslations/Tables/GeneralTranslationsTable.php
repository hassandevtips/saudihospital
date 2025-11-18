<?php

namespace App\Filament\Resources\GeneralTranslations\Tables;

use App\Filament\Resources\GeneralTranslations\Pages\EditGeneralTranslation;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GeneralTranslationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Key')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('medium'),

                TextColumn::make('value')
                    ->label('Text Content')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (is_array($state)) {
                            $state = json_encode($state, JSON_UNESCAPED_UNICODE);
                        }
                        return strlen($state) > 50 ? $state : null;
                    }),

                TextColumn::make('group')
                    ->label('Group')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->default('—'),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter(),

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
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),

                SelectFilter::make('group')
                    ->label('Group')
                    ->options(function () {
                        return \App\Models\GeneralTranslation::query()
                            ->whereNotNull('group')
                            ->distinct()
                            ->pluck('group', 'group')
                            ->toArray();
                    })
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('order', 'asc');
    }
}
