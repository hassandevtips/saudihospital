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
        if (Schema::hasTable('languages')) {
            Schema::table('languages', function (Blueprint $table) {
                if (!Schema::hasColumn('languages', 'code')) {
                    $table->string('code', 10)->unique()->after('id');
                }
                if (!Schema::hasColumn('languages', 'name')) {
                    $table->string('name')->after('code');
                }
                if (!Schema::hasColumn('languages', 'native_name')) {
                    $table->string('native_name')->after('name');
                }
                if (!Schema::hasColumn('languages', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('native_name');
                }
                if (!Schema::hasColumn('languages', 'is_default')) {
                    $table->boolean('is_default')->default(false)->after('is_active');
                }
                if (!Schema::hasColumn('languages', 'order')) {
                    $table->integer('order')->default(0)->after('is_default');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('languages')) {
            Schema::table('languages', function (Blueprint $table) {
                $columns = ['code', 'name', 'native_name', 'is_active', 'is_default', 'order'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('languages', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
