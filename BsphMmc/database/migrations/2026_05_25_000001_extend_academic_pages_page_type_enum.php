<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE academic_pages MODIFY COLUMN page_type ENUM('overview','partnership','dept_epidemiology','dept_health_management','dept_program') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE academic_pages MODIFY COLUMN page_type ENUM('overview','partnership') NOT NULL");
    }
};
