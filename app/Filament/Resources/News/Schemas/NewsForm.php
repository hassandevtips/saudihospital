<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->label('News Image')
                    ->directory('news')
                    ->disk('public')
                    ->columnSpanFull(),
                FileUpload::make('banner_image')
                    ->image()
                    ->label('Breadcrumb Banner Image')
                    ->directory('news/banners')
                    ->disk('public')
                    ->helperText('Image displayed in the breadcrumb section at the top of the news detail page')
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->required()
                    ->default('admin'),
                DatePicker::make('published_date')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
