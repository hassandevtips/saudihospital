<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\DepartmentDoctors;
use App\Livewire\PageView;
use App\Livewire\DoctorsTemplate;
use App\Livewire\DoctorDetails;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\NewsDetails;


Route::get('/', HomePage::class)->name('home');
Route::get('/departments', DepartmentDoctors::class)->name('department-doctors');
Route::get('/departments/{department}', DoctorsTemplate::class)->name('doctors');
Route::get('/doctors/{doctor}', DoctorDetails::class)->name('doctor-details');
Route::get('/news/{id}', NewsDetails::class)->name('news-details');

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage Link';
});

// Optimize Clear
Route::get('/optimize-clear', function () {
    try {
        Artisan::call('optimize:clear');
        return 'Optimize Clear';
    } catch (\Exception $e) {
        return 'Optimize Clear Failed: ' . $e->getMessage();
    }
});

// Show Config
Route::get('/config', function () {;
    return  Artisan::call('config:show');
});

// Migrate Database
Route::get('/migrate', function () {
    try {
        Artisan::call('migrate');
        return 'Migrate Database Success';
    } catch (\Exception $e) {
        return 'Migrate Database Failed: ' . $e->getMessage();
    }
});


// Dynamic page routes
Route::get('/{slug}', PageView::class)
    ->where('slug', '[a-z0-9-]+')
    ->name('page');
