<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use App\Models\Menu;
use App\Models\Language;
use Livewire\Component;

class Header extends Component
{
    public $settings;
    public $menu;
    public $languages;
    public $currentLocale;
    public $toggleLanguage;

    public function mount()
    {
        $this->loadSettings();
        $this->loadMenu();
        $this->loadLanguages();
    }

    /**
     * Load site settings
     */
    protected function loadSettings()
    {
        $this->settings = [
            'site_name' => SiteSetting::get('site_name', 'Saudi Hospital'),
            'tagline' => SiteSetting::get('tagline', 'The New Definition of Healthcare'),
            'phone' => SiteSetting::get('phone', '0096265564400'),
            'email' => SiteSetting::get('email', 'info@alsaudihospital.com'),
            'address' => SiteSetting::get('address', 'Jordan - Amman - Khalda - Wasfi Al-Tall St.'),
            'facebook' => SiteSetting::get('facebook', '#'),
            'twitter' => SiteSetting::get('twitter', '#'),
            'linkedin' => SiteSetting::get('linkedin', '#'),
            'instagram' => SiteSetting::get('instagram', '#'),
            'youtube' => SiteSetting::get('youtube', '#'),
            'logo' => SiteSetting::get('logo', 'assets/images/logo.png'),
            'google_maps_api_key' => SiteSetting::get('google_maps_api_key', 'AIzaSyCCx15fv0E_h9qqf43omAi6LXs9fhnzdLA'),
        ];
    }

    /**
     * Load menu with current locale
     */
    protected function loadMenu()
    {
        // Ensure locale is set before loading menu
        $locale = session('locale');
        if ($locale) {
            app()->setLocale($locale);
        }

        // Load the header menu with items relationship
        // Unset any cached relationships to force fresh load
        $this->menu = Menu::with(['items.children'])
            ->where('key', 'header')
            ->where('activated', true)
            ->first();

        // Clear any cached menu items to ensure fresh translation
        if ($this->menu) {
            $this->menu->unsetRelation('items');
            $this->menu->load(['items.children']);
        }
    }

    /**
     * Load languages
     */
    protected function loadLanguages()
    {
        try {
            $this->languages = Language::active()->get();
        } catch (\Exception $e) {
            $this->languages = collect();
        }
        $this->currentLocale = session('locale', app()->getLocale());
        $this->toggleLanguage = $this->getToggleLanguage();
    }

    public function getToggleLanguage()
    {
        if (!$this->languages || $this->languages->count() < 2) {
            return null;
        }

        // Get the language that is NOT the current locale
        $otherLanguage = $this->languages->filter(function ($language) {
            return $language->code !== $this->currentLocale;
        })->first();

        // Fallback to first language if somehow not found
        return $otherLanguage ?: $this->languages->first();
    }

    public function switchToToggleLanguage()
    {
        $toggleLang = $this->getToggleLanguage();

        if ($toggleLang) {
            $this->switchLanguage($toggleLang->code);
        }
    }

    public function switchLanguage($locale)
    {
        // Verify the language exists and is active
        $language = Language::where('code', $locale)
            ->where('is_active', true)
            ->first();

        if ($language) {
            // Set locale in session and application
            session(['locale' => $locale]);
            app()->setLocale($locale);
            $this->currentLocale = $locale;

            // Reload menu with new locale
            $this->loadMenu();

            // Update toggle language
            $this->toggleLanguage = $this->getToggleLanguage();

            // Redirect to refresh the page with new locale
            return redirect()->to(request()->header('Referer') ?: url('/'));
        }
    }

    /**
     * Update menu when locale changes (for Livewire updates)
     */
    public function updatedCurrentLocale()
    {
        $this->loadMenu();
    }

    public function getMenuItems()
    {
        if (!$this->menu) {
            return [];
        }
        // Items will be automatically translated by the model's getItemsArray method
        return $this->menu->getItemsArray();
    }

    public function render()
    {
        // Ensure locale is synchronized before rendering
        $sessionLocale = session('locale');
        if ($sessionLocale && app()->getLocale() !== $sessionLocale) {
            app()->setLocale($sessionLocale);
            $this->currentLocale = $sessionLocale;
        }

        return view('livewire.includes.header');
    }
}
