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
        Schema::table('home_page_contents', function (Blueprint $table) {
            $table->string('stats_doctors_icon')->default('icon-25')->after('stats_centers');
            $table->string('stats_beds_icon')->default('icon-26')->after('stats_doctors_icon');
            $table->string('stats_clinics_icon')->default('icon-27')->after('stats_beds_icon');
            $table->string('stats_centers_icon')->default('icon-28')->after('stats_clinics_icon');
            $table->string('video_url')->nullable()->after('stats_centers_icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_page_contents', function (Blueprint $table) {
            $table->dropColumn(['stats_doctors_icon', 'stats_beds_icon', 'stats_clinics_icon', 'stats_centers_icon', 'video_url']);
        });
    }
};
