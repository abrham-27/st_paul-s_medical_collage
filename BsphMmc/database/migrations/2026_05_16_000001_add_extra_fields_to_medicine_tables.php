<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medicine_departments', function (Blueprint $table) {
            if (!Schema::hasColumn('medicine_departments', 'image')) {
                $table->string('image')->nullable()->after('icon');
            }
        });

        Schema::table('medicine_sub_departments', function (Blueprint $table) {
            if (!Schema::hasColumn('medicine_sub_departments', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('medicine_sub_departments', 'image')) {
                $table->string('image')->nullable()->after('icon');
            }
        });

        Schema::table('academic_units', function (Blueprint $table) {
            if (!Schema::hasColumn('academic_units', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicine_departments', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('medicine_sub_departments', function (Blueprint $table) {
            $table->dropColumn(['slug', 'image']);
        });

        Schema::table('academic_units', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
