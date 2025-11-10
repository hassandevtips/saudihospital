<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_page_contents', function (Blueprint $table) {
            $table->id();

            // About Section
            $table->string('about_image')->nullable();
            $table->integer('about_years')->default(10);
            $table->text('about_years_text')->nullable();
            $table->text('about_subtitle')->nullable();
            $table->text('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->json('key_highlights')->nullable(); // Array of highlights
            $table->json('services_offered')->nullable(); // Array of services

            // Stats Section
            $table->integer('stats_doctors')->default(100);
            $table->integer('stats_beds')->default(120);
            $table->integer('stats_clinics')->default(20);
            $table->integer('stats_centers')->default(5);

            // Pharmacy Section
            $table->text('pharmacy_title')->nullable();
            $table->text('pharmacy_description')->nullable();
            $table->json('pharmacy_services')->nullable(); // Array of services
            $table->string('pharmacy_image')->nullable();

            // Insurances Section
            $table->text('insurances_title')->nullable();
            $table->json('insurance_logos')->nullable(); // Array of image paths

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_contents');
    }
};
