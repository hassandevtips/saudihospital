<?php

namespace App\Filament\Resources\BoardMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BoardMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('position')
                    ->label('Position / Title')
                    ->maxLength(255),
                Textarea::make('bio')
                    ->label('Biography')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->label('Profile Image')
                    ->directory('board-members')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('facebook_url')
                    ->label('Facebook URL')
                    ->url()
                    ->maxLength(255),
                TextInput::make('twitter_url')
                    ->label('X / Twitter URL')
                    ->url()
                    ->maxLength(255),
                TextInput::make('linkedin_url')
                    ->label('LinkedIn URL')
                    ->url()
                    ->maxLength(255),
                TextInput::make('pinterest_url')
                    ->label('Pinterest URL')
                    ->url()
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
                TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Lower numbers appear first.'),
            ]);
    }
}
