<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    public function up(): void
    {
        Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\NursingDepartmentSeeder', '--force' => true]);
    }

    public function down(): void
    {
        // Data preserved on rollback of create migration
    }
};
