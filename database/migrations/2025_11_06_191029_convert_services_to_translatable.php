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
        // Store existing data
        $services = DB::table('services')->get()->map(function ($svc) {
            return [
                'id' => $svc->id,
                'title' => $svc->title ?? '',
                'description' => $svc->description ?? '',
            ];
        })->toArray();

        // Convert title to JSON
        if (Schema::hasColumn('services', 'title')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }

        Schema::table('services', function (Blueprint $table) {
            $table->json('title')->after('id');
        });

        // Convert description to JSON
        if (Schema::hasColumn('services', 'description')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

        Schema::table('services', function (Blueprint $table) {
            $table->json('description')->after('title');
        });

        // Restore data as JSON
        foreach ($services as $svc) {
            $titleJson = json_encode(['en' => $svc['title']]);
            $descJson = json_encode(['en' => $svc['description']]);
            DB::table('services')
                ->where('id', $svc['id'])
                ->update([
                    'title' => $titleJson,
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
        $services = DB::table('services')->get()->map(function ($svc) {
            $titleJson = json_decode($svc->title, true);
            $descJson = json_decode($svc->description, true);
            return [
                'id' => $svc->id,
                'title' => is_array($titleJson) ? ($titleJson['en'] ?? ($titleJson[array_key_first($titleJson)] ?? '')) : '',
                'description' => is_array($descJson) ? ($descJson['en'] ?? ($descJson[array_key_first($descJson)] ?? '')) : '',
            ];
        })->toArray();

        // Convert title back to string
        if (Schema::hasColumn('services', 'title')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }

        Schema::table('services', function (Blueprint $table) {
            $table->string('title')->after('id');
        });

        // Convert description back to text
        if (Schema::hasColumn('services', 'description')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }

        Schema::table('services', function (Blueprint $table) {
            $table->text('description')->after('title');
        });

        // Restore data
        foreach ($services as $svc) {
            DB::table('services')
                ->where('id', $svc['id'])
                ->update([
                    'title' => $svc['title'],
                    'description' => $svc['description']
                ]);
        }
    }
};
