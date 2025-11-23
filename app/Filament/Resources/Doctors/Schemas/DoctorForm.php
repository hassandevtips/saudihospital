<?php

namespace App\Filament\Resources\Doctors\Schemas;

use App\Models\Department;
use App\Models\Location;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
                Select::make('location_id')
                    ->label('Location')
                    ->options(function () {
                        return Location::query()->active()->get()->mapWithKeys(function ($location) {
                            return [$location->id => $location->name];
                        });
                    })
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText('Assign doctor to a location'),
                TextInput::make('specialization')
                    ->required()
                    ->maxLength(255)
                    ->label('Specialization'),
                Textarea::make('bio')
                    ->label('Biography')
                    ->rows(4)
                    ->columnSpanFull(),
                RichEditor::make('skills')
                    ->label('Skills')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'link',
                        'undo',
                        'redo',
                    ])
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->label('Profile Photo')
                    ->directory('doctors')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),
                FileUpload::make('banner_image')
                    ->image()
                    ->label('Breadcrumb Banner Image')
                    ->directory('doctors/banners')
                    ->disk('public')
                    ->imageEditor()
                    ->helperText('Image displayed in the breadcrumb section at the top of the doctor detail page')
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
