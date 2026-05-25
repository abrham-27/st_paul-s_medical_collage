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
        Schema::table('research_projects', function (Blueprint $table) {
            // Add structured content fields for IRB
            $table->json('legal_framework')->nullable(); // For Legal & Regulatory Framework section
            $table->json('irb_structure')->nullable(); // For Structure of IRB section
            $table->json('appointment_training')->nullable(); // For Appointment & Training section
            $table->json('additional_sections')->nullable(); // For any additional structured content
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('research_projects', function (Blueprint $table) {
            $table->dropColumn([
                'legal_framework',
                'irb_structure', 
                'appointment_training',
                'additional_sections'
            ]);
        });
    }
};
