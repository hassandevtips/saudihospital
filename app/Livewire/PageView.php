<?php

namespace App\Livewire;

use App\Models\BoardMember;
use App\Models\Faq;
use App\Models\Page;
use App\Models\SiteSetting;
use Livewire\Component;
use Livewire\Attributes\Locked;

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
            default => 'livewire.pages.default',
        };

        $boardMembers = $templateView === 'livewire.pages.board-members'
            ? BoardMember::query()->active()->get()
            : collect();

        $faqs = $templateView === 'livewire.pages.faqs-template'
            ? Faq::query()->active()->get()
            : collect();


        return view('livewire.page-view', [
            'page' => $this->page,
            'settings' => $this->settings,
            'templateView' => $templateView,
            'boardMembers' => $boardMembers,
            'faqs' => $faqs,
        ]);
    }
}
