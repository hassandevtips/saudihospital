<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class IconReference extends Page
{
    protected string $view = 'filament.pages.icon-reference';

    public static function getNavigationLabel(): string
    {
        return 'Icon Reference';
    }

    public function getTitle(): string
    {
        return 'Icon Reference Guide';
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-swatch';
    }

    public static function getNavigationSort(): ?int
    {
        return 999;
    }

    public function getIcons(): array
    {
        $icons = [];
        for ($i = 1; $i <= 59; $i++) {
            $icons[] = "icon-{$i}";
        }
        return $icons;
    }
}
