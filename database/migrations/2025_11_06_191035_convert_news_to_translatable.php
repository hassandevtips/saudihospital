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
        $news = DB::table('news')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title ?? '',
                'content' => $item->content ?? '',
            ];
        })->toArray();

        // Convert title to JSON
        if (Schema::hasColumn('news', 'title')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
        Schema::table('news', function (Blueprint $table) {
            $table->json('title')->after('id');
        });

        // Convert content to JSON
        if (Schema::hasColumn('news', 'content')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('content');
            });
        }
        Schema::table('news', function (Blueprint $table) {
            $table->json('content')->after('title');
        });

        // Restore data as JSON
        foreach ($news as $item) {
            DB::table('news')
                ->where('id', $item['id'])
                ->update([
                    'title' => json_encode(['en' => $item['title']]),
                    'content' => json_encode(['en' => $item['content']]),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data
        $news = DB::table('news')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $this->extractFromJson($item->title),
                'content' => $this->extractFromJson($item->content),
            ];
        })->toArray();

        // Convert back to string/text
        if (Schema::hasColumn('news', 'title')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('title');
            });
            Schema::table('news', function (Blueprint $table) {
                $table->string('title')->after('id');
            });
        }

        if (Schema::hasColumn('news', 'content')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('content');
            });
            Schema::table('news', function (Blueprint $table) {
                $table->text('content')->after('title');
            });
        }

        // Restore data
        foreach ($news as $item) {
            DB::table('news')
                ->where('id', $item['id'])
                ->update($item);
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
