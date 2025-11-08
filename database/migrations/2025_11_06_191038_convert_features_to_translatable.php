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
        $features = DB::table('features')->get()->map(function ($feature) {
            return [
                'id' => $feature->id,
                'title' => $feature->title ?? '',
                'description' => $feature->description ?? '',
            ];
        })->toArray();

        // Convert title to JSON
        if (Schema::hasColumn('features', 'title')) {
            Schema::table('features', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
        Schema::table('features', function (Blueprint $table) {
            $table->json('title')->after('id');
        });

        // Convert description to JSON
        if (Schema::hasColumn('features', 'description')) {
            Schema::table('features', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
        Schema::table('features', function (Blueprint $table) {
            $table->json('description')->after('title');
        });

        // Restore data as JSON
        foreach ($features as $feature) {
            DB::table('features')
                ->where('id', $feature['id'])
                ->update([
                    'title' => json_encode(['en' => $feature['title']]),
                    'description' => json_encode(['en' => $feature['description']]),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data
        $features = DB::table('features')->get()->map(function ($feature) {
            return [
                'id' => $feature->id,
                'title' => $this->extractFromJson($feature->title),
                'description' => $this->extractFromJson($feature->description),
            ];
        })->toArray();

        // Convert back to string/text
        if (Schema::hasColumn('features', 'title')) {
            Schema::table('features', function (Blueprint $table) {
                $table->dropColumn('title');
            });
            Schema::table('features', function (Blueprint $table) {
                $table->string('title')->after('id');
            });
        }

        if (Schema::hasColumn('features', 'description')) {
            Schema::table('features', function (Blueprint $table) {
                $table->dropColumn('description');
            });
            Schema::table('features', function (Blueprint $table) {
                $table->text('description')->after('title');
            });
        }

        // Restore data
        foreach ($features as $feature) {
            DB::table('features')
                ->where('id', $feature['id'])
                ->update($feature);
        }
    }

    private function extractFromJson($json): string
    {
        if (empty($json)) return '';
        $decoded = json_decode($json, true);
        if (is_array($decoded)) {
            return $decoded['en'] ?? ($decoded[array_key_first($decoded)] ?? '');
        }
        return '';
    }
};
