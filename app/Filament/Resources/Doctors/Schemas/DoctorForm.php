<?php

namespace App\Filament\Resources\Doctors\Schemas;

use App\Models\Department;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Doctor Name')
                    ->columnSpanFull(),
                Select::make('department_id')
                    ->label('Department')
                    ->options(function () {
                        return Department::query()->get()->mapWithKeys(function ($department) {
                            return [$department->id => $department->name];
                        });
                    })
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('Assign doctor to a department'),
                TextInput::make('specialization')
                    ->required()
                    ->maxLength(255)
                    ->label('Specialization'),
                Textarea::make('bio')
                    ->label('Biography')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->label('Profile Photo')
                    ->directory('doctors')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->maxLength(20),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
                TextInput::make('order')
                    ->label('Display Order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
            ]);
    }
}
