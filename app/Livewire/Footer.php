<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\SiteSetting;
use Livewire\Component;

class Footer extends Component
{
    public $settings;
    public $departments;

    public function mount()
    {
        $this->settings = [
            'site_name' => SiteSetting::get('site_name', 'Saudi Hospital'),
            'phone' => SiteSetting::get('phone', '0096265564414'),
            'email' => SiteSetting::get('email', 'info@alsaudihospital.com'),
            'address' => SiteSetting::get('address', 'Jordan - Amman - Khalda - Wasfi Al-Tall St.'),
            'facebook' => SiteSetting::get('facebook', '#'),
            'twitter' => SiteSetting::get('twitter', '#'),
            'linkedin' => SiteSetting::get('linkedin', '#'),
        ];

        // Load active departments for footer
        $this->departments = Department::active()->orderBy('order')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.includes.footer');
    }
}
