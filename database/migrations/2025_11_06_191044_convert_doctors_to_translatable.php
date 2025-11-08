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
        $doctors = DB::table('doctors')->get()->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->name ?? '',
                'specialization' => $doctor->specialization ?? '',
                'bio' => $doctor->bio ?? '',
            ];
        })->toArray();

        // Convert name to JSON
        if (Schema::hasColumn('doctors', 'name')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
        Schema::table('doctors', function (Blueprint $table) {
            $table->json('name')->after('department_id');
        });

        // Convert specialization to JSON
        if (Schema::hasColumn('doctors', 'specialization')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('specialization');
            });
        }
        Schema::table('doctors', function (Blueprint $table) {
            $table->json('specialization')->nullable()->after('name');
        });

        // Convert bio to JSON
        if (Schema::hasColumn('doctors', 'bio')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('bio');
            });
        }
        Schema::table('doctors', function (Blueprint $table) {
            $table->json('bio')->nullable()->after('specialization');
        });

        // Restore data as JSON
        foreach ($doctors as $doctor) {
            DB::table('doctors')
                ->where('id', $doctor['id'])
                ->update([
                    'name' => json_encode(['en' => $doctor['name']]),
                    'specialization' => json_encode(['en' => $doctor['specialization']]),
                    'bio' => json_encode(['en' => $doctor['bio']]),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Store existing JSON data
        $doctors = DB::table('doctors')->get()->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $this->extractFromJson($doctor->name),
                'specialization' => $this->extractFromJson($doctor->specialization),
                'bio' => $this->extractFromJson($doctor->bio),
            ];
        })->toArray();

        // Convert back to string/text
        if (Schema::hasColumn('doctors', 'name')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('name');
            });
            Schema::table('doctors', function (Blueprint $table) {
                $table->string('name')->after('department_id');
            });
        }

        if (Schema::hasColumn('doctors', 'specialization')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('specialization');
            });
            Schema::table('doctors', function (Blueprint $table) {
                $table->string('specialization')->nullable()->after('name');
            });
        }

        if (Schema::hasColumn('doctors', 'bio')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('bio');
            });
            Schema::table('doctors', function (Blueprint $table) {
                $table->text('bio')->nullable()->after('specialization');
            });
        }

        // Restore data
        foreach ($doctors as $doctor) {
            DB::table('doctors')
                ->where('id', $doctor['id'])
                ->update($doctor);
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
