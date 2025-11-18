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
        Schema::create('general_translations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('Unique identifier for the translation');
            $table->text('value')->comment('Translatable text content');
            $table->string('group')->nullable()->comment('Optional group to organize translations');
            $table->text('description')->nullable()->comment('Optional description for context');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_translations');
    }
};

