<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\DepartmentDoctors;
use App\Livewire\PageView;
use Illuminate\Support\Facades\Artisan;

Route::get('/', HomePage::class)->name('home');
Route::get('/doctors', DepartmentDoctors::class)->name('department-doctors');


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage Link';
});

// Optimize Clear
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimize Clear test';
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
