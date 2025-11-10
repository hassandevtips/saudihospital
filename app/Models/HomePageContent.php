<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomePageContent extends Model
{
    use HasTranslations;

    public $translatable = [
        'about_years_text',
        'about_subtitle',
        'about_title',
        'about_description',
        'key_highlights',
        'services_offered',
        'pharmacy_title',
        'pharmacy_description',
        'pharmacy_services',
        'insurances_title'
    ];

    protected $fillable = [
        'about_image',
        'about_years',
        'about_years_text',
        'about_subtitle',
        'about_title',
        'about_description',
        'key_highlights',
        'services_offered',
        'stats_doctors',
        'stats_beds',
        'stats_clinics',
        'stats_centers',
        'pharmacy_title',
        'pharmacy_description',
        'pharmacy_services',
        'pharmacy_image',
        'insurances_title',
        'insurance_logos',
        'is_active'
    ];

    protected $casts = [
        'about_years_text' => 'array',
        'about_subtitle' => 'array',
        'about_title' => 'array',
        'about_description' => 'array',
        'key_highlights' => 'array',
        'services_offered' => 'array',
        'pharmacy_title' => 'array',
        'pharmacy_description' => 'array',
        'pharmacy_services' => 'array',
        'insurances_title' => 'array',
        'insurance_logos' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getContent()
    {
        return self::active()->first() ?? new self();
    }

    // Helper methods for image URLs
    public function getAboutImageUrlAttribute()
    {
        if (!$this->about_image) {
            return asset('assets/images/resource/about-1.jpg');
        }
        if (str_starts_with($this->about_image, 'assets')) {
            return asset($this->about_image);
        }
        return asset('storage/' . $this->about_image);
    }

    public function getPharmacyImageUrlAttribute()
    {
        if (!$this->pharmacy_image) {
            return asset('assets/images/resource/chooseus-1.png');
        }
        if (str_starts_with($this->pharmacy_image, 'assets')) {
            return asset($this->pharmacy_image);
        }
        return asset('storage/' . $this->pharmacy_image);
    }

    // Helper to get array items safely
    public function getKeyHighlightsList()
    {
        $highlights = $this->getTranslation('key_highlights', app()->getLocale(), false);
        if (!$highlights) {
            // Try to get from default locale or first available
            $highlights = $this->getTranslation('key_highlights', config('app.locale'), false)
                ?? $this->getTranslation('key_highlights', 'en', false)
                ?? $this->key_highlights;
        }

        if (is_array($highlights)) {
            return array_filter(array_map(function ($item) {
                if (is_array($item) && isset($item['item'])) {
                    return $item['item'];
                }
                return is_string($item) ? $item : null;
            }, $highlights));
        }
        return [];
    }

    public function getServicesOfferedList()
    {
        $services = $this->getTranslation('services_offered', app()->getLocale(), false);
        if (!$services) {
            $services = $this->getTranslation('services_offered', config('app.locale'), false)
                ?? $this->getTranslation('services_offered', 'en', false)
                ?? $this->services_offered;
        }

        if (is_array($services)) {
            return array_filter(array_map(function ($item) {
                if (is_array($item) && isset($item['item'])) {
                    return $item['item'];
                }
                return is_string($item) ? $item : null;
            }, $services));
        }
        return [];
    }
}
