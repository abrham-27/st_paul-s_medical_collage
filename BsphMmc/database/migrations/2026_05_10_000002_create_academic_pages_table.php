<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_pages', function (Blueprint $table) {
            $table->id();
            $table->enum('school_type', ['medicine', 'nursing', 'public_health']);
            $table->enum('page_type', ['overview', 'partnership']);
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('secondary_title')->nullable();
            $table->longText('secondary_content')->nullable();
            $table->string('tertiary_title')->nullable();
            $table->longText('tertiary_content')->nullable();
            $table->string('featured_image')->nullable();
            $table->timestamps();

            $table->unique(['school_type', 'page_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_pages');
    }
};
