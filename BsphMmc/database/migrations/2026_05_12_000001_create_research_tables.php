<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Research pages (for Background, Mission & Vision content)
        Schema::create('research_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_type'); // background, mission, vision
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            // Ensure one record per page type
            $table->unique('page_type');
        });

        // Research goals
        Schema::create('research_goals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_goals');
        Schema::dropIfExists('research_pages');
    }
};
