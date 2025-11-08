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
        $banners = DB::table('banners')->get()->map(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $banner->title ?? '',
                'description' => $banner->description ?? '',
                'button_text' => $banner->button_text ?? '',
            ];
        })->toArray();

        // Convert title to JSON
        if (Schema::hasColumn('banners', 'title')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
        Schema::table('banners', function (Blueprint $table) {
            $table->json('title')->after('id');
        });

        // Convert description to JSON
        if (Schema::hasColumn('banners', 'description')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
        Schema::table('banners', function (Blueprint $table) {
            $table->json('description')->after('title');
        });

        // Convert button_text to JSON
        if (Schema::hasColumn('banners', 'button_text')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('button_text');
            });
        }
        Schema::table('banners', function (Blueprint $table) {
            $table->json('button_text')->nullable()->after('description');
        });

        // Restore data as JSON
        foreach ($banners as $banner) {
            DB::table('banners')
                ->where('id', $banner['id'])
                ->update([
                    'title' => json_encode(['en' => $banner['title']]),
                    'description' => json_encode(['en' => $banner['description']]),
                    'button_text' => json_encode(['en' => $banner['button_text']]),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data
        $banners = DB::table('banners')->get()->map(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $this->extractFromJson($banner->title),
                'description' => $this->extractFromJson($banner->description),
                'button_text' => $this->extractFromJson($banner->button_text),
            ];
        })->toArray();

        // Convert back to string/text
        if (Schema::hasColumn('banners', 'title')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('title');
            });
            Schema::table('banners', function (Blueprint $table) {
                $table->string('title')->after('id');
            });
        }

        if (Schema::hasColumn('banners', 'description')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('description');
            });
            Schema::table('banners', function (Blueprint $table) {
                $table->text('description')->after('title');
            });
        }

        if (Schema::hasColumn('banners', 'button_text')) {
            Schema::table('banners', function (Blueprint $table) {
                $table->dropColumn('button_text');
            });
            Schema::table('banners', function (Blueprint $table) {
                $table->string('button_text')->nullable()->after('description');
            });
        }

        // Restore data
        foreach ($banners as $banner) {
            DB::table('banners')
                ->where('id', $banner['id'])
                ->update($banner);
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
