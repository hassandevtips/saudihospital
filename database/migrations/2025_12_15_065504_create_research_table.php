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
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('content');
            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('video')->nullable();
            $table->json('gallery')->nullable();
            $table->string('author')->default('admin');
            $table->date('published_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
