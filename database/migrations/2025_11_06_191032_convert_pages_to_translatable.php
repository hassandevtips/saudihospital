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
        $pages = DB::table('pages')->get()->map(function ($page) {
            return [
                'id' => $page->id,
                'title' => $page->title ?? '',
                'content' => $page->content ?? '',
                'meta_title' => $page->meta_title ?? '',
                'meta_description' => $page->meta_description ?? '',
                'meta_keywords' => $page->meta_keywords ?? '',
            ];
        })->toArray();

        // Convert title to JSON
        if (Schema::hasColumn('pages', 'title')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }
        Schema::table('pages', function (Blueprint $table) {
            $table->json('title')->after('id');
        });

        // Convert content to JSON
        if (Schema::hasColumn('pages', 'content')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('content');
            });
        }
        Schema::table('pages', function (Blueprint $table) {
            $table->json('content')->nullable()->after('slug');
        });

        // Convert meta_title to JSON
        if (Schema::hasColumn('pages', 'meta_title')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('meta_title');
            });
        }
        Schema::table('pages', function (Blueprint $table) {
            $table->json('meta_title')->nullable()->after('template');
        });

        // Convert meta_description to JSON
        if (Schema::hasColumn('pages', 'meta_description')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('meta_description');
            });
        }
        Schema::table('pages', function (Blueprint $table) {
            $table->json('meta_description')->nullable()->after('meta_title');
        });

        // Convert meta_keywords to JSON
        if (Schema::hasColumn('pages', 'meta_keywords')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('meta_keywords');
            });
        }
        Schema::table('pages', function (Blueprint $table) {
            $table->json('meta_keywords')->nullable()->after('meta_description');
        });

        // Restore data as JSON
        foreach ($pages as $page) {
            DB::table('pages')
                ->where('id', $page['id'])
                ->update([
                    'title' => json_encode(['en' => $page['title']]),
                    'content' => json_encode(['en' => $page['content']]),
                    'meta_title' => json_encode(['en' => $page['meta_title']]),
                    'meta_description' => json_encode(['en' => $page['meta_description']]),
                    'meta_keywords' => json_encode(['en' => $page['meta_keywords']]),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data
        $pages = DB::table('pages')->get()->map(function ($page) {
            return [
                'id' => $page->id,
                'title' => $this->extractFromJson($page->title),
                'content' => $this->extractFromJson($page->content),
                'meta_title' => $this->extractFromJson($page->meta_title),
                'meta_description' => $this->extractFromJson($page->meta_description),
                'meta_keywords' => $this->extractFromJson($page->meta_keywords),
            ];
        })->toArray();

        // Convert back to string/text
        if (Schema::hasColumn('pages', 'title')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('title');
            });
            Schema::table('pages', function (Blueprint $table) {
                $table->string('title')->after('id');
            });
        }

        if (Schema::hasColumn('pages', 'content')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('content');
            });
            Schema::table('pages', function (Blueprint $table) {
                $table->text('content')->nullable()->after('slug');
            });
        }

        if (Schema::hasColumn('pages', 'meta_title')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('meta_title');
            });
            Schema::table('pages', function (Blueprint $table) {
                $table->string('meta_title')->nullable()->after('template');
            });
        }

        if (Schema::hasColumn('pages', 'meta_description')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('meta_description');
            });
            Schema::table('pages', function (Blueprint $table) {
                $table->text('meta_description')->nullable()->after('meta_title');
            });
        }

        if (Schema::hasColumn('pages', 'meta_keywords')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('meta_keywords');
            });
            Schema::table('pages', function (Blueprint $table) {
                $table->text('meta_keywords')->nullable()->after('meta_description');
            });
        }

        // Restore data
        foreach ($pages as $page) {
            DB::table('pages')
                ->where('id', $page['id'])
                ->update($page);
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
