<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;

class ContactSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextEntry::make('name')
                    ->label(__('Name')),
                TextEntry::make('email')
                    ->label(__('Email'))
                    ->copyable(),
                TextEntry::make('phone')
                    ->label(__('Phone'))
                    ->placeholder('-')
                    ->copyable(),
                TextEntry::make('subject')
                    ->label(__('Subject'))
                    ->placeholder('-'),
                TextEntry::make('message')
                    ->label(__('Message'))
                    ->columnSpanFull()
                    ->placeholder('-')
                    ->wrap(),
                TextEntry::make('ip_address')
                    ->label(__('IP Address'))
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->label(__('Submitted At'))
                    ->columnSpanFull()
                    ->formatStateUsing(static function (?string $state): string {
                        if (blank($state)) {
                            return '-';
                        }

                        return Carbon::parse($state)->format('Y-m-d H:i');
                    }),
                TextEntry::make('updated_at')
                    ->label(__('Updated At'))
                    ->columnSpanFull()
                    ->formatStateUsing(static function (?string $state): string {
                        if (blank($state)) {
                            return '-';
                        }

                        return Carbon::parse($state)->format('Y-m-d H:i');
                    }),
            ]);
    }
}
