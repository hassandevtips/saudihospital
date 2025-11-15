<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\DepartmentDoctors;
use App\Livewire\PageView;
use App\Livewire\DoctorsTemplate;
use App\Livewire\DoctorDetails;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\NewsDetails;
use App\Livewire\Career\CareerDetails;
use App\Livewire\FormSubmissionComponent;
use App\Livewire\ClinicDetails;
use App\Livewire\FindADoctor;


Route::get('/', HomePage::class)->name('home');
Route::get('/find-a-doctor', FindADoctor::class)->name('find-a-doctor');
Route::get('/departments', DepartmentDoctors::class)->name('department-doctors');
Route::get('/departments/{department}', DoctorsTemplate::class)->name('doctors');
Route::get('/doctors/{doctor}', DoctorDetails::class)->name('doctor-details');
Route::get('/news/{id}', NewsDetails::class)->name('news-details');
Route::get('/careers/{slug}', CareerDetails::class)->name('career-details');
Route::get('/clinics/{slug}', ClinicDetails::class)->name('clinic.details');

// Form Submission Routes - Multiple types (internship, training, volunteer, etc.)
Route::get('/forms/{type}', FormSubmissionComponent::class)
    ->where('type', 'internship|training|volunteer|research|fellowship|shadowing')
    ->name('form-submission');

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
Route::get('/filament-clear', function () {
    try {
        Artisan::call('filament:optimize-clear');
        return 'Filament Clear';
    } catch (\Exception $e) {
        return 'Filament Clear Failed: ' . $e->getMessage();
    }
});


// Dynamic page routes
Route::get('/{slug}', PageView::class)
    ->where('slug', '[a-z0-9-]+')
    ->name('page');
