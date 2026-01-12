<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Banner;
use App\Models\Feature;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\News;
use App\Models\SiteSetting;
use TomatoPHP\FilamentMenus\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data
        Banner::truncate();
        Feature::truncate();
        Doctor::truncate();
        Service::truncate();
        News::truncate();
        SiteSetting::truncate();
        Menu::truncate();

        // Seed Banners
        Banner::create([
            'title' => 'Trusted Healthcare Services',
            'description' => 'Over the years, thanks to the trust of our community and the commitment of our staff!',
            'image' => 'assets/images/banner/banner-1.jpg',
            'button_text' => 'Meet Our Doctors',
            'button_link' => '#',
            'is_active' => true,
            'order' => 1
        ]);

        Banner::create([
            'title' => 'Advanced Medical Technology',
            'description' => 'State-of-the-art equipment and cutting-edge treatments for better patient outcomes.',
            'image' => 'assets/images/banner/banner-2.jpg',
            'button_text' => 'Learn More',
            'button_link' => '#',
            'is_active' => true,
            'order' => 2
        ]);

        Banner::create([
            'title' => 'Compassionate Care Team',
            'description' => 'Dedicated professionals committed to your health and well-being.',
            'image' => 'assets/images/banner/banner-3.jpg',
            'button_text' => 'Book Appointment',
            'button_link' => '#',
            'is_active' => true,
            'order' => 3
        ]);

        // Seed Features
        Feature::create([
            'title' => 'Qualified Doctors',
            'description' => 'Saudi Hospital is a leading private healthcare institution committed to delivering high-quality.',
            'icon_class' => 'icon-12',
            'is_active' => true,
            'order' => 1
        ]);

        Feature::create([
            'title' => 'Multidisciplinary Care',
            'description' => 'Saudi Hospital is a leading private healthcare institution committed to delivering high-quality.',
            'icon_class' => 'icon-13',
            'is_active' => true,
            'order' => 2
        ]);

        Feature::create([
            'title' => 'Emergency 24/7',
            'description' => 'Saudi Hospital is a leading private healthcare institution committed to delivering high-quality.',
            'icon_class' => 'icon-14',
            'is_active' => true,
            'order' => 3
        ]);

        Feature::create([
            'title' => 'Patient Centered Care',
            'description' => 'Saudi Hospital is a leading private healthcare institution committed to delivering high-quality.',
            'icon_class' => 'icon-15',
            'is_active' => true,
            'order' => 4
        ]);

        // Seed Doctors
        Doctor::create([
            'name' => 'Dr. Nada Nabil Bader',
            'specialization' => 'Nephrology and Internal Diseases',
            'bio' => 'Experienced nephrologist with over 15 years of practice.',
            'image' => 'assets/images/team/team-1.jpg',
            'email' => 'dr.nada@alsaudihospital.com',
            'phone' => '0096265564414',
            'is_active' => true,
            'order' => 1
        ]);

        Doctor::create([
            'name' => 'Dr. Aseem Nammas',
            'specialization' => 'Cardiologist and Cardiac',
            'bio' => 'Specialized in cardiac care and interventional cardiology.',
            'image' => 'assets/images/team/team-2.jpg',
            'email' => 'dr.aseem@alsaudihospital.com',
            'phone' => '0096265564414',
            'is_active' => true,
            'order' => 2
        ]);

        Doctor::create([
            'name' => 'Dr. Walid Youssef Farah',
            'specialization' => 'Internal Medicine Consultant',
            'bio' => 'Expert in general internal medicine and patient care.',
            'image' => 'assets/images/team/team-3.jpg',
            'email' => 'dr.walid@alsaudihospital.com',
            'phone' => '0096265564414',
            'is_active' => true,
            'order' => 3
        ]);

        // Seed Services
        Service::create([
            'title' => 'Cardiology and Heart Center',
            'description' => 'We focus on accuracy safety and speed with care plans tailored to each patients.',
            'image' => 'assets/images/service/service-2.jpg',
            'icon_class' => 'icon-17',
            'link' => '#',
            'is_active' => true,
            'order' => 1
        ]);

        Service::create([
            'title' => 'Dental and Maxillofacial',
            'description' => 'We focus on accuracy safety and speed with care plans tailored to each patients.',
            'image' => 'assets/images/service/service-3.jpg',
            'icon_class' => 'icon-18',
            'link' => '#',
            'is_active' => true,
            'order' => 2
        ]);

        Service::create([
            'title' => 'Radiology Diagnostic',
            'description' => 'We focus on accuracy safety and speed with care plans tailored to each patients.',
            'image' => 'assets/images/service/service-4.jpg',
            'icon_class' => 'icon-19',
            'link' => '#',
            'is_active' => true,
            'order' => 3
        ]);

        // Seed News
        News::create([
            'title' => 'Pulmonology Clinic',
            'content' => 'We believe every patient has the right to be treated with dignity. Our pulmonology department offers comprehensive respiratory care.',
            'image' => 'assets/images/news/news-1.jpg',
            'author' => 'admin',
            'published_date' => '2025-10-10',
            'is_active' => true
        ]);

        News::create([
            'title' => 'The Regular Check-Ups',
            'content' => 'We believe every patient has the right to be treated with dignity. Regular health check-ups are essential for early detection and prevention.',
            'image' => 'assets/images/news/news-2.jpg',
            'author' => 'admin',
            'published_date' => '2025-10-09',
            'is_active' => true
        ]);

        News::create([
            'title' => 'Oncology Surgery Unit',
            'content' => 'We believe every patient has the right to be treated with dignity. Our oncology unit provides cutting-edge cancer treatment.',
            'image' => 'assets/images/news/news-3.jpg',
            'author' => 'admin',
            'published_date' => '2025-10-08',
            'is_active' => true
        ]);

        // Seed Site Settings
        SiteSetting::create([
            'key' => 'site_name',
            'value' => 'Saudi Hospital',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'tagline',
            'value' => 'The New Definition of Healthcare',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'phone',
            'value' => '0096265564400',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'email',
            'value' => 'info@alsaudihospital.com',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'address',
            'value' => 'Jordan - Amman - Khalda - Wasfi Al-Tall St.',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'facebook',
            'value' => '#',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'twitter',
            'value' => '#',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'linkedin',
            'value' => '#',
            'type' => 'text'
        ]);

        SiteSetting::create([
            'key' => 'logo',
            'value' => 'assets/images/logo.png',
            'type' => 'text'
        ]);

        // Seed Header Menu
        Menu::create([
            'key' => 'header',
            'location' => 'header',
            'title' => 'Main Navigation',
            'items' => [
                [
                    'title' => 'Home',
                    'url' => '/',
                    'blank' => false,
                    'children' => []
                ],
                [
                    'title' => 'About Us',
                    'url' => '#',
                    'blank' => false,
                    'children' => [
                        ['title' => 'Our History', 'url' => '#', 'blank' => false],
                        ['title' => 'Core Values', 'url' => '#', 'blank' => false],
                        ['title' => 'Group Overview', 'url' => '#', 'blank' => false],
                        ['title' => 'Board Members', 'url' => '#', 'blank' => false],
                        ['title' => 'Vision Mission', 'url' => '#', 'blank' => false],
                        ['title' => 'Our Doctors', 'url' => '#', 'blank' => false]
                    ]
                ],
                [
                    'title' => 'Clinics',
                    'url' => '#',
                    'blank' => false,
                    'children' => [
                        ['title' => 'Pharmacies', 'url' => '#', 'blank' => false],
                        ['title' => 'Patient Relations', 'url' => '#', 'blank' => false],
                        ['title' => 'Partners and Network', 'url' => '#', 'blank' => false],
                        ['title' => 'Nursing', 'url' => '#', 'blank' => false],
                        ['title' => 'Medical Tourism', 'url' => '#', 'blank' => false],
                        ['title' => 'Laboratory', 'url' => '#', 'blank' => false]
                    ]
                ],
                [
                    'title' => 'Our Departments',
                    'url' => '#',
                    'blank' => false,
                    'children' => [
                        ['title' => 'Cardiology and Heart Center', 'url' => '#', 'blank' => false],
                        ['title' => 'Dental and Maxillofacial', 'url' => '#', 'blank' => false],
                        ['title' => 'Orthopedics Sport Injuries', 'url' => '#', 'blank' => false],
                        ['title' => 'ENT', 'url' => '#', 'blank' => false],
                        ['title' => 'Gastroenterology and Hepatology', 'url' => '#', 'blank' => false],
                        ['title' => 'Radiology Interventional Diagnostic', 'url' => '#', 'blank' => false],
                        ['title' => 'Hemodialysis Center', 'url' => '#', 'blank' => false],
                        ['title' => 'Maternity and Women\'s Health Center', 'url' => '#', 'blank' => false]
                    ]
                ],
                [
                    'title' => 'Our Doctors',
                    'url' => '#',
                    'blank' => false,
                    'children' => []
                ],
                [
                    'title' => 'Media',
                    'url' => '#',
                    'blank' => false,
                    'children' => []
                ],
                [
                    'title' => 'Contact Us',
                    'url' => '#',
                    'blank' => false,
                    'children' => []
                ]
            ],
            'activated' => true
        ]);

        // Create admin user if not exists
        if (!User::where('email', 'admin@alsaudihospital.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@alsaudihospital.com',
                'password' => bcrypt('password'),
            ]);
        }

        $this->command->info('Database seeded successfully!');
    }
}
