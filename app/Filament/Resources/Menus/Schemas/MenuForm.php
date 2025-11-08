<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use App\Models\MenuItem;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                    ->label('Menu Title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('key')
                    ->label('Menu Key')
                    ->hint('Unique identifier for this menu (e.g., header, footer)')
                    ->required()
                    ->unique(ignorable: fn($record) => $record)
                    ->maxLength(255),
                TextInput::make('location')
                    ->label('Menu Location')
                    ->default('header')
                    ->required()
                    ->maxLength(255),
                Repeater::make('items')
                    ->label('Menu Items')
                    ->relationship(
                        name: 'items',
                        modifyQueryUsing: fn($query) => $query->orderBy('order'),
                    )
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data, $livewire): array {
                        // Filament should automatically set menu_id via relationship,
                        // but ensure it's explicitly set as a fallback
                        $owner = $livewire->getOwnerRecord();
                        if ($owner && method_exists($owner, 'getKey')) {
                            $data['menu_id'] = $owner->getKey();
                        }
                        // Ensure order is set if not provided
                        if (!isset($data['order'])) {
                            $data['order'] = 0;
                        }
                        // Ensure title is properly formatted as array for translatable
                        if (isset($data['title']) && is_string($data['title'])) {
                            $locale = $livewire->activeLocale ?? app()->getLocale();
                            $data['title'] = [$locale => $data['title']];
                        }
                        return $data;
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data, $livewire): array {
                        // Handle translation merging when updating existing items
                        if (isset($data['id'])) {
                            $item = \App\Models\MenuItem::find($data['id']);
                            if ($item && $item->title) {
                                $existingTitle = is_array($item->title) ? $item->title : ['en' => $item->title];
                                $locale = $livewire->activeLocale ?? app()->getLocale();

                                // If title is provided as string, merge it with existing translations
                                if (isset($data['title']) && is_string($data['title'])) {
                                    $existingTitle[$locale] = $data['title'];
                                    $data['title'] = $existingTitle;
                                } elseif (!isset($data['title'])) {
                                    // Preserve existing title if not being updated
                                    $data['title'] = $existingTitle;
                                }
                            }
                        }
                        return $data;
                    })
                    ->schema([
                        TextInput::make('title')
                            ->label('Item Title')
                            ->required()
                            ->maxLength(255)
                            ->formatStateUsing(function ($state, $livewire) {
                                // Handle translatable title field
                                if (is_array($state)) {
                                    $locale = $livewire->activeLocale ?? app()->getLocale();
                                    return $state[$locale] ?? $state['en'] ?? ($state[array_key_first($state)] ?? '');
                                }
                                return is_string($state) ? $state : '';
                            })
                            ->dehydrateStateUsing(function ($state, $livewire, callable $get) {
                                // Get existing translations from the related record
                                $existingTitle = [];
                                if (isset($livewire->ownerRecord) && $livewire->ownerRecord) {
                                    // Try to get existing menu item if editing
                                    $itemId = $get('../../id');
                                    if ($itemId) {
                                        $item = \App\Models\MenuItem::find($itemId);
                                        if ($item && $item->title) {
                                            $existingTitle = is_array($item->title) ? $item->title : ['en' => $item->title];
                                        }
                                    }
                                }

                                // Merge with current locale value
                                $locale = $livewire->activeLocale ?? app()->getLocale();
                                if (!is_array($existingTitle)) {
                                    $existingTitle = [];
                                }
                                $existingTitle[$locale] = $state;

                                return $existingTitle;
                            }),
                        TextInput::make('url')
                            ->label('Item URL')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('blank')
                            ->label('Open in new window')
                            ->default(false),
                        Repeater::make('children')
                            ->label('Sub Menu Items')
                            ->relationship('children')
                            ->mutateRelationshipDataBeforeCreateUsing(function (array $data, $livewire): array {
                                // For nested children, ownerRecord is the parent MenuItem
                                // We need to get the menu_id from the parent item's menu relationship
                                if (isset($livewire->ownerRecord)) {
                                    $parentItem = $livewire->ownerRecord;
                                    if ($parentItem instanceof \App\Models\MenuItem) {
                                        $data['menu_id'] = $parentItem->menu_id;
                                        $data['parent_id'] = $parentItem->id;
                                    }
                                }
                                // Ensure title is properly formatted as array for translatable
                                if (isset($data['title']) && is_string($data['title'])) {
                                    $locale = $livewire->activeLocale ?? app()->getLocale();
                                    $data['title'] = [$locale => $data['title']];
                                }
                                return $data;
                            })
                            ->mutateRelationshipDataBeforeSaveUsing(function (array $data, $livewire): array {
                                // Handle translation merging when updating existing children
                                if (isset($data['id'])) {
                                    $child = \App\Models\MenuItem::find($data['id']);
                                    if ($child && $child->title) {
                                        $existingTitle = is_array($child->title) ? $child->title : ['en' => $child->title];
                                        $locale = $livewire->activeLocale ?? app()->getLocale();

                                        // If title is provided as string, merge it with existing translations
                                        if (isset($data['title']) && is_string($data['title'])) {
                                            $existingTitle[$locale] = $data['title'];
                                            $data['title'] = $existingTitle;
                                        } elseif (!isset($data['title'])) {
                                            // Preserve existing title if not being updated
                                            $data['title'] = $existingTitle;
                                        }
                                    }
                                }
                                return $data;
                            })
                            ->schema([
                                TextInput::make('title')
                                    ->label('Item Title')
                                    ->required()
                                    ->maxLength(255)
                                    ->formatStateUsing(function ($state, $livewire) {
                                        // Handle translatable title field
                                        if (is_array($state)) {
                                            $locale = $livewire->activeLocale ?? app()->getLocale();
                                            return $state[$locale] ?? $state['en'] ?? ($state[array_key_first($state)] ?? '');
                                        }
                                        return is_string($state) ? $state : '';
                                    })
                                    ->dehydrateStateUsing(function ($state, $livewire, callable $get) {
                                        // Get existing translations from the related record
                                        $existingTitle = [];
                                        // Try to get existing child menu item if editing
                                        $childId = $get('../../../id');
                                        if ($childId) {
                                            $child = \App\Models\MenuItem::find($childId);
                                            if ($child && $child->title) {
                                                $existingTitle = is_array($child->title) ? $child->title : ['en' => $child->title];
                                            }
                                        }

                                        // Merge with current locale value
                                        $locale = $livewire->activeLocale ?? app()->getLocale();
                                        if (!is_array($existingTitle)) {
                                            $existingTitle = [];
                                        }
                                        $existingTitle[$locale] = $state;

                                        return $existingTitle;
                                    }),
                                TextInput::make('url')
                                    ->label('Item URL')
                                    ->required()
                                    ->maxLength(255),
                                Toggle::make('blank')
                                    ->label('Open in new window')
                                    ->default(false),
                            ])
                            ->itemLabel(function (array $state, $livewire): ?string {
                                $title = $state['title'] ?? null;
                                if (is_array($title)) {
                                    $locale = $livewire->activeLocale ?? app()->getLocale();
                                    return $title[$locale] ?? $title['en'] ?? ($title[array_key_first($title)] ?? '');
                                }
                                return is_string($title) ? $title : null;
                            })
                            ->collapsible()
                            ->collapsed()
                            ->defaultItems(0),
                    ])
                    ->itemLabel(function (array $state, $livewire): ?string {
                        $title = $state['title'] ?? null;
                        if (is_array($title)) {
                            $locale = $livewire->activeLocale ?? app()->getLocale();
                            return $title[$locale] ?? $title['en'] ?? ($title[array_key_first($title)] ?? '');
                        }
                        return is_string($title) ? $title : null;
                    })
                    ->collapsible()
                    ->collapsed()
                    ->defaultItems(0)
                    ->orderColumn('order')
                    ->reorderable(),
                Toggle::make('activated')
                    ->label('Active')
                    ->default(true)
                    ->required(),
            ]);
    }
}
