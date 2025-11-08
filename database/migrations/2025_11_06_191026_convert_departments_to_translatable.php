<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Store existing data BEFORE dropping columns
        $departments = DB::table('departments')->get()->map(function ($dept) {
            return [
                'id' => $dept->id,
                'name' => $dept->name ?? '',
                'description' => $dept->description ?? '',
            ];
        })->toArray();

        // Drop and recreate name column as JSON
        if (Schema::hasColumn('departments', 'name')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }

        Schema::table('departments', function (Blueprint $table) {
            $table->json('name')->after('id');
        });

        // Drop and recreate description column as JSON
        if (Schema::hasColumn('departments', 'description')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

        Schema::table('departments', function (Blueprint $table) {
            $table->json('description')->nullable()->after('name');
        });

        // Restore data as JSON
        foreach ($departments as $dept) {
            $nameJson = json_encode(['en' => $dept['name']]);
            $descJson = json_encode(['en' => $dept['description']]);
            DB::table('departments')
                ->where('id', $dept['id'])
                ->update([
                    'name' => $nameJson,
                    'description' => $descJson
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data
        $departments = DB::table('departments')->get()->map(function ($dept) {
            $nameJson = json_decode($dept->name, true);
            $descJson = json_decode($dept->description, true);
            return [
                'id' => $dept->id,
                'name' => is_array($nameJson) ? ($nameJson['en'] ?? ($nameJson[array_key_first($nameJson)] ?? '')) : '',
                'description' => is_array($descJson) ? ($descJson['en'] ?? ($descJson[array_key_first($descJson)] ?? '')) : '',
            ];
        })->toArray();

        // Convert name back to string
        if (Schema::hasColumn('departments', 'name')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }

        Schema::table('departments', function (Blueprint $table) {
            $table->string('name')->after('id');
        });

        // Convert description back to text
        if (Schema::hasColumn('departments', 'description')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

        Schema::table('departments', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
        });

        // Restore data as string/text
        foreach ($departments as $dept) {
            DB::table('departments')
                ->where('id', $dept['id'])
                ->update([
                    'name' => $dept['name'],
                    'description' => $dept['description']
                ]);
        }
    }
};
