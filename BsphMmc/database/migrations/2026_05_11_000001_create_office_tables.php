<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Office about/CMS pages
        Schema::create('office_pages', function (Blueprint $table) {
            $table->id();
            $table->string('office_type'); // ict, registrar, library
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->timestamps();
            $table->unique('office_type');
        });

        // Office gallery images
        Schema::create('office_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('office_type');
            $table->string('title')->nullable();
            $table->string('image');
            $table->string('category')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Office services
        Schema::create('office_services', function (Blueprint $table) {
            $table->id();
            $table->string('office_type');
            $table->string('title');
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Office projects
        Schema::create('office_projects', function (Blueprint $table) {
            $table->id();
            $table->string('office_type');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->timestamps();
        });

        // Office processes (for registration workflows, etc.)
        Schema::create('office_processes', function (Blueprint $table) {
            $table->id();
            $table->string('office_type');
            $table->integer('step_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Office contact info
        Schema::create('office_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('office_type')->unique();
            $table->string('office_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('working_hours')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('office_contacts');
        Schema::dropIfExists('office_processes');
        Schema::dropIfExists('office_projects');
        Schema::dropIfExists('office_services');
        Schema::dropIfExists('office_galleries');
        Schema::dropIfExists('office_pages');
    }
};
