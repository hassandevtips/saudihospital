<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Feature;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\News;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'banners' => Banner::active()->get(),
            'features' => Feature::active()->get(),
            'doctors' => Doctor::active()->take(3)->get(),
            'services' => Service::active()->take(3)->get(),
            'news' => News::active()->take(3)->get(),
            'settings' => [
                'site_name' => SiteSetting::get('site_name', 'Saudi Hospital'),
                'tagline' => SiteSetting::get('tagline', 'The New Definition of Healthcare'),
                'phone' => SiteSetting::get('phone', '0096265564414'),
                'email' => SiteSetting::get('email', 'info@alsaudihospital.com'),
                'address' => SiteSetting::get('address', 'Jordan - Amman - Khalda - Wasfi Al-Tall St.'),
                'facebook' => SiteSetting::get('facebook', '#'),
                'twitter' => SiteSetting::get('twitter', '#'),
                'linkedin' => SiteSetting::get('linkedin', '#'),
            ]
        ];

        return view('welcome', $data);
    }
}
