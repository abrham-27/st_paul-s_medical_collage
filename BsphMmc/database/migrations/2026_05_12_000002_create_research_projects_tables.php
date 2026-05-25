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
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_type'); // irb, idream, hdss
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();
            
            // Index for faster lookups
            $table->index(['project_type', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_projects');
    }
};
