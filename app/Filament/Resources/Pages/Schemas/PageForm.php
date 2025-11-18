<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Department;
use App\Models\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->label('Page Title')
                    ->columnSpanFull()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->label('URL Slug')
                    ->unique(ignoreRecord: true)
                    ->helperText('The URL-friendly version of the title')
                    ->columnSpanFull(),

                Select::make('template')
                    ->label('Page Template')
                    ->options(Page::getTemplates())
                    ->default('default')
                    ->required()
                    ->helperText('Choose a template for this page')
                    ->columnSpanFull(),

                Select::make('department_id')
                    ->label('Department')
                    ->options(Department::active()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable()
                    ->helperText('Link this page to a department (optional)')
                    ->columnSpanFull(),

                Select::make('parent_id')
                    ->label('Parent Page')
                    ->options(function ($record) {
                        // Get all pages except the current one (to prevent self-referencing)
                        $query = Page::query();
                        if ($record) {
                            $query->where('id', '!=', $record->id);
                        }
                        return $query->pluck('title', 'id');
                    })
                    ->searchable()
                    ->nullable()
                    ->helperText('Select a parent page to make this a sub-page (optional)')
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Page Content')

                    ->helperText('Add your HTML or rich text content here.') // Optional helper text
                    ->columnSpanFull(),

                FileUpload::make('featured_image')
                    ->image()
                    ->label('Featured Image')
                    ->directory('pages')
                    ->disk('public')
                    ->imageEditor()
                    ->columnSpanFull(),

                FileUpload::make('banner_image')
                    ->image()
                    ->label('Banner Image')
                    ->directory('pages')
                    ->disk('public')
                    ->imageEditor()
                    ->helperText('Banner image displayed at the top of the page')
                    ->columnSpanFull(),

                TextInput::make('meta_title')
                    ->label('Meta Title')
                    ->maxLength(255)
                    ->helperText('Leave empty to use page title'),

                Textarea::make('meta_description')
                    ->label('Meta Description')
                    ->rows(3)
                    ->maxLength(255)
                    ->helperText('Brief description for search engines'),

                Textarea::make('meta_keywords')
                    ->label('Meta Keywords')
                    ->rows(2)
                    ->maxLength(255)
                    ->helperText('Comma-separated keywords')
                    ->columnSpanFull(),

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
