<?php

namespace App\Livewire;

use App\Models\BoardMember;
use App\Models\Faq;
use App\Models\Location;
use App\Models\Page;
use App\Models\SiteSetting;
use Livewire\Component;
use Livewire\Attributes\Locked;
use App\Models\Partner;

class PageView extends Component
{
    #[Locked]
    public $slug;

    public $page;
    public $settings;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->with(['children' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->firstOrFail();

        // Load settings for the view
        $this->settings = [
            'site_name' => SiteSetting::get('site_name', 'Saudi Hospital'),
            'phone' => SiteSetting::get('phone', '0096265564414'),
            'email' => SiteSetting::get('email', 'info@alsaudihospital.com'),
            'address' => SiteSetting::get('address', 'Jordan - Amman - Khalda - Wasfi Al-Tall St.'),
            'facebook' => SiteSetting::get('facebook', '#'),
            'twitter' => SiteSetting::get('twitter', '#'),
            'linkedin' => SiteSetting::get('linkedin', '#'),
            'google_maps_api_key' => SiteSetting::get('google_maps_api_key', 'AIzaSyCCx15fv0E_h9qqf43omAi6LXs9fhnzdLA'),
        ];
    }

    public function render()
    {
        // Choose template based on page template setting
        $templateView = match ($this->page->template) {
            'home' => 'livewire.pages.home',
            'department-template' => 'livewire.pages.department-template',
            'contact' => 'livewire.pages.contact',
            'news-template' => 'livewire.pages.news-template',
            'board-members' => 'livewire.pages.board-members',
            'faqs-template' => 'livewire.pages.faqs-template',
            'page-with-sub-links' => 'livewire.pages.page-with-sub-links',
            'suggestions-template' => 'livewire.pages.suggestions-template',
            'career-template' => 'livewire.pages.career-template',
            'clinics-template' => 'livewire.pages.clinics-template',
            'bmi-template' => 'livewire.pages.bmi-template',
            'ideal_weight_calculator' => 'livewire.pages.ideal_weight_calculator',
            'period' => 'livewire.pages.period',
            'pregnancy' => 'livewire.pages.pregnancy',
            'protien' => 'livewire.pages.protien',
            'calorie' => 'livewire.pages.calorie',
            'working-hours-template' => 'livewire.pages.working-hours-template',
            'find-a-doctor' => 'livewire.pages.find-a-doctor',
            'our-history-template' => 'livewire.pages.our-history-template',
            'partners-template' => 'livewire.pages.partners-template',
            'research-template' => 'livewire.pages.research-template',
            default => 'livewire.pages.default',
        };

        $boardMembers = $templateView === 'livewire.pages.board-members'
            ? BoardMember::query()->active()->get()
            : collect();

        $faqs = $templateView === 'livewire.pages.faqs-template'
            ? Faq::query()->active()->get()
            : collect();

        $locations = $templateView === 'livewire.pages.working-hours-template'
            ? Location::query()->active()->get()
            : collect();

        $partners = $templateView === 'livewire.pages.partners-template'
            ? Partner::query()->active()->get()
            : collect();

        // Map locations for Google Maps JavaScript
        $locationsForMap = $locations->map(function ($location) {
            return [
                'id' => $location->id,
                'name' => $location->name,
                'address' => $location->address,
                'lat' => (float) $location->latitude,
                'lng' => (float) $location->longitude,
                'phone' => $location->phone,
                'email' => $location->email,
                'marker_icon' => $location->marker_icon_url,
            ];
        });

        return view('livewire.page-view', [
            'page' => $this->page,
            'settings' => $this->settings,
            'templateView' => $templateView,
            'boardMembers' => $boardMembers,
            'faqs' => $faqs,
            'locations' => $locations,
            'locationsForMap' => $locationsForMap,
            'partners' => $partners,
        ]);
    }
}
