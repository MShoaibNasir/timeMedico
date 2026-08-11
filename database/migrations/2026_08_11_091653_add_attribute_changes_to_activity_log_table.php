<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_log', function (Blueprint $table) {
            if (! Schema::hasColumn('activity_log', 'attribute_changes')) {
                $table->json('attribute_changes')->nullable()->after('causer_id');
            }
        });

        // Move tracked changes from properties (v4) into attribute_changes (v5).
        DB::table('activity_log')->whereNotNull('properties')->orderBy('id')->chunkById(100, function ($rows) {
            foreach ($rows as $row) {
                $properties = json_decode($row->properties, true) ?: [];
                $changes = array_intersect_key($properties, array_flip(['attributes', 'old']));
                $remaining = array_diff_key($properties, array_flip(['attributes', 'old']));

                if ($changes === []) {
                    continue;
                }

                DB::table('activity_log')->where('id', $row->id)->update([
                    'attribute_changes' => json_encode($changes),
                    'properties' => $remaining === [] ? null : json_encode($remaining),
                ]);
            }
        });

        if (Schema::hasColumn('activity_log', 'batch_uuid')) {
            Schema::table('activity_log', function (Blueprint $table) {
                $table->dropColumn('batch_uuid');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('activity_log', 'batch_uuid')) {
            Schema::table('activity_log', function (Blueprint $table) {
                $table->uuid('batch_uuid')->nullable()->after('properties');
            });
        }

        if (Schema::hasColumn('activity_log', 'attribute_changes')) {
            Schema::table('activity_log', function (Blueprint $table) {
                $table->dropColumn('attribute_changes');
            });
        }
    }
};
