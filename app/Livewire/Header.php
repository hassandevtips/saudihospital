<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use App\Models\Menu;
use Livewire\Component;

class Header extends Component
{
    public $settings;
    public $menu;

    public function mount()
    {
        $this->settings = [
            'site_name' => SiteSetting::get('site_name', 'Saudi Hospital'),
            'tagline' => SiteSetting::get('tagline', 'The New Definition of Healthcare'),
            'phone' => SiteSetting::get('phone', '0096265564414'),
            'email' => SiteSetting::get('email', 'info@alsaudihospital.com'),
            'address' => SiteSetting::get('address', 'Jordan - Amman - Khalda - Wasfi Al-Tall St.'),
            'facebook' => SiteSetting::get('facebook', '#'),
            'twitter' => SiteSetting::get('twitter', '#'),
            'linkedin' => SiteSetting::get('linkedin', '#'),
            'logo' => SiteSetting::get('logo', 'assets/images/logo.png'),
        ];

        // Load the header menu with items relationship
        $this->menu = Menu::with(['items.children'])
            ->where('key', 'header')
            ->where('activated', true)
            ->first();
    }

    public function getMenuItems()
    {
        if (!$this->menu || !$this->menu->items) {
            return [];
        }
        // Items will be automatically translated by the model's accessor
        return $this->menu->items;
    }

    public function render()
    {
        return view('livewire.includes.header');
    }
}
