<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hero Section Content
        Schema::create('role_responsibility_content', function (Blueprint $table) {
            $table->id();
            $table->string('section_type'); // 'hero', 'overview'
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique(['section_type']);
        });

        // Responsibility Categories
        Schema::create('role_responsibility_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->text('summary');
            $table->longText('detailed_content');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Workflow/Process Steps
        Schema::create('role_responsibility_processes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->integer('step_number');
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Policy/Document Management
        Schema::create('role_responsibility_policies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_type'); // pdf, doc, etc
            $table->string('file_size')->nullable();
            $table->string('category')->nullable(); // guidelines, sop, policy
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // FAQ
        Schema::create('role_responsibility_faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->longText('answer');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Statistics/Highlights
        Schema::create('role_responsibility_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('value');
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Contact Information
        Schema::create('role_responsibility_contact', function (Blueprint $table) {
            $table->id();
            $table->string('office_name');
            $table->string('office_location')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('office_hours')->nullable();
            $table->string('website')->nullable();
            $table->longText('additional_info')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique(['office_name']);
        });

        // Add indexes for performance
        Schema::table('role_responsibility_categories', function (Blueprint $table) {
            $table->index('status');
            $table->index('sort_order');
        });

        Schema::table('role_responsibility_processes', function (Blueprint $table) {
            $table->index('status');
            $table->index('step_number');
        });

        Schema::table('role_responsibility_policies', function (Blueprint $table) {
            $table->index('status');
            $table->index('category');
        });

        Schema::table('role_responsibility_faqs', function (Blueprint $table) {
            $table->index('status');
            $table->index('sort_order');
        });

        Schema::table('role_responsibility_statistics', function (Blueprint $table) {
            $table->index('status');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_responsibility_contact');
        Schema::dropIfExists('role_responsibility_statistics');
        Schema::dropIfExists('role_responsibility_faqs');
        Schema::dropIfExists('role_responsibility_policies');
        Schema::dropIfExists('role_responsibility_processes');
        Schema::dropIfExists('role_responsibility_categories');
        Schema::dropIfExists('role_responsibility_content');
    }
};
