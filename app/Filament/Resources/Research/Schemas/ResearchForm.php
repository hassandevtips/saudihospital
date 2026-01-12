<?php

namespace App\Filament\Resources\Research\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResearchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->translateLabel()
                    ->columnSpanFull(),
            RichEditor::make('content')
                ->required()
                ->toolbarButtons([
                    'attachFiles',
                    'blockquote',
                    'bold',
                    'bulletList',
                    'codeBlock',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ])
                ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->label('Research Image')
                    ->directory('research')
                    ->disk('public')
                    ->columnSpanFull(),
                FileUpload::make('banner_image')
                    ->image()
                    ->label('Breadcrumb Banner Image')
                    ->directory('research/banners')
                    ->disk('public')
                    ->helperText('Image displayed in the breadcrumb section at the top of the research detail page')
                    ->columnSpanFull(),
                FileUpload::make('video')
                    ->label('Video')
                    ->directory('research/videos')
                    ->disk('public')
                    ->acceptedFileTypes(['video/mp4', 'video/mpeg', 'video/quicktime', 'video/x-msvideo', 'video/webm'])
                    ->maxSize(102400)
                    ->helperText('Upload a video file (MP4, MOV, AVI, WebM). Max size: 100MB')
                    ->columnSpanFull(),
                FileUpload::make('video_thumbnail')
                    ->label('Video Thumbnail/Cover Photo')
                    ->directory('research/video-thumbnails')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->helperText('Upload a cover photo/thumbnail for the video. This will be displayed before the video plays.')
                    ->columnSpanFull(),
                FileUpload::make('gallery')
                    ->label('Gallery Images')
                    ->directory('research/gallery')
                    ->disk('public')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(10)
                    ->helperText('Upload multiple images for the gallery. You can reorder them by dragging.')
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

