<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Main research projects table
        if (!Schema::hasTable('research_projects_v2')) {
            Schema::create('research_projects_v2', function (Blueprint $table) {
                $table->id();
                $table->string('project_type')->unique(); // irb, idream, hdss
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->text('overview')->nullable();
                $table->string('hero_image')->nullable();
                $table->json('cta_buttons')->nullable(); // [{text, url, type}]
                $table->string('contact_email')->nullable();
                $table->string('contact_phone')->nullable();
                $table->text('contact_address')->nullable();
                $table->text('office_hours')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        // Key functions/services
        if (!Schema::hasTable('research_project_functions_v2')) {
            Schema::create('research_project_functions_v2', function (Blueprint $table) {
                $table->id();
                $table->foreignId('research_project_id')->constrained('research_projects_v2')->onDelete('cascade');
                $table->string('title');
                $table->text('description');
                $table->string('icon')->nullable();
                $table->json('features')->nullable(); // array of feature strings
                $table->integer('order_index')->default(0);
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        // Workflow/process steps
        if (!Schema::hasTable('research_project_workflows_v2')) {
            Schema::create('research_project_workflows_v2', function (Blueprint $table) {
                $table->id();
                $table->foreignId('research_project_id')->constrained('research_projects_v2')->onDelete('cascade');
                $table->string('title');
                $table->text('description');
                $table->integer('step_number');
                $table->string('icon')->nullable();
                $table->string('estimated_time')->nullable();
                $table->json('requirements')->nullable(); // array of requirement strings
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        // Resources/documents
        if (!Schema::hasTable('research_project_resources_v2')) {
            Schema::create('research_project_resources_v2', function (Blueprint $table) {
                $table->id();
                $table->foreignId('research_project_id')->constrained('research_projects_v2')->onDelete('cascade');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('file_path')->nullable();
                $table->string('file_type')->nullable();
                $table->string('file_size')->nullable();
                $table->string('external_url')->nullable();
                $table->string('icon')->nullable();
                $table->integer('order_index')->default(0);
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        // Statistics/highlights
        if (!Schema::hasTable('research_project_statistics_v2')) {
            Schema::create('research_project_statistics_v2', function (Blueprint $table) {
                $table->id();
                $table->foreignId('research_project_id')->constrained('research_projects_v2')->onDelete('cascade');
                $table->string('label');
                $table->string('value');
                $table->text('description')->nullable();
                $table->string('icon')->nullable();
                $table->string('color')->nullable();
                $table->integer('order_index')->default(0);
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        // Team members
        if (!Schema::hasTable('research_project_team_members_v2')) {
            Schema::create('research_project_team_members_v2', function (Blueprint $table) {
                $table->id();
                $table->foreignId('research_project_id')->constrained('research_projects_v2')->onDelete('cascade');
                $table->string('name');
                $table->string('role');
                $table->text('bio')->nullable();
                $table->string('image')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->integer('order_index')->default(0);
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        // FAQ
        if (!Schema::hasTable('research_project_faqs_v2')) {
            Schema::create('research_project_faqs_v2', function (Blueprint $table) {
                $table->id();
                $table->foreignId('research_project_id')->constrained('research_projects_v2')->onDelete('cascade');
                $table->string('question');
                $table->text('answer');
                $table->integer('order_index')->default(0);
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('research_project_faqs_v2');
        Schema::dropIfExists('research_project_team_members_v2');
        Schema::dropIfExists('research_project_statistics_v2');
        Schema::dropIfExists('research_project_resources_v2');
        Schema::dropIfExists('research_project_workflows_v2');
        Schema::dropIfExists('research_project_functions_v2');
        Schema::dropIfExists('research_projects_v2');
    }
};