<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => ['en' => 'Partner 1', 'ar' => 'شريك 1'],
                'logo' => 'assets/images/news/brand-1.png',
                'website_url' => 'https://example.com',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => ['en' => 'Partner 2', 'ar' => 'شريك 2'],
                'logo' => 'assets/images/news/brand-2.png',
                'website_url' => 'https://example.com',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => ['en' => 'Partner 3', 'ar' => 'شريك 3'],
                'logo' => 'assets/images/news/brand-3.png',
                'website_url' => 'https://example.com',
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}


