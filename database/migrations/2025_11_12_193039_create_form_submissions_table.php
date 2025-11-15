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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->index(); // internship, training, volunteer, etc.
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('national_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('education_level')->nullable();
            $table->string('university')->nullable();
            $table->string('major')->nullable();
            $table->string('current_position')->nullable();
            $table->string('resume_url')->nullable();
            $table->text('cover_letter')->nullable();
            $table->text('message')->nullable();
            $table->json('additional_data')->nullable(); // For any extra fields specific to form type
            $table->string('status')->default('pending'); // pending, reviewed, accepted, rejected
            $table->text('admin_notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
