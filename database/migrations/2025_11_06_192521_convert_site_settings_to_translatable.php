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
        $settings = DB::table('site_settings')->get()->map(function ($setting) {
            return [
                'id' => $setting->id,
                'value' => $setting->value ?? '',
                'type' => $setting->type ?? 'text',
            ];
        })->toArray();

        // Convert value to JSON (only for text type settings)
        if (Schema::hasColumn('site_settings', 'value')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('value');
            });
        }
        Schema::table('site_settings', function (Blueprint $table) {
            $table->json('value')->nullable()->after('key');
        });

        // Restore data as JSON (only for text types, others stay as is)
        foreach ($settings as $setting) {
            $value = $setting['value'];
            // Only convert to JSON if it's a text type setting and contains text
            if ($setting['type'] === 'text' && !empty($value)) {
                $value = json_encode(['en' => $value]);
            } else {
                // For non-text types or empty values, store as is but wrap in JSON
                $value = !empty($value) ? json_encode(['en' => $value]) : null;
            }

            DB::table('site_settings')
                ->where('id', $setting['id'])
                ->update(['value' => $value]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data
        $settings = DB::table('site_settings')->get()->map(function ($setting) {
            return [
                'id' => $setting->id,
                'value' => $this->extractFromJson($setting->value),
            ];
        })->toArray();

        // Convert back to text
        if (Schema::hasColumn('site_settings', 'value')) {
            Schema::table('site_settings', function (Blueprint $table) {
                $table->dropColumn('value');
            });
            Schema::table('site_settings', function (Blueprint $table) {
                $table->text('value')->nullable()->after('key');
            });
        }

        // Restore data
        foreach ($settings as $setting) {
            DB::table('site_settings')
                ->where('id', $setting['id'])
                ->update($setting);
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
