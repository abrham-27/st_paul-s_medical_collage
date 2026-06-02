<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([
            'partnership_statistics',
            'partnership_areas',
            'success_stories',
            'partnership_documents',
            'partners',
        ] as $table) {
            if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                DB::table($table)->update(['is_active' => true]);
            }
        }
    }

    public function down(): void
    {
        // no rollback
    }
};
