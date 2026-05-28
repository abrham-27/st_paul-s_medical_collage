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
        // Team Members Table
        Schema::create('research_project_team_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_project_id');
            $table->string('name');
            $table->string('role');
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('order_index')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('research_project_id')->references('id')->on('research_projects')->onDelete('cascade');
            $table->index(['research_project_id', 'status', 'order_index']);
        });

        // FAQs Table
        Schema::create('research_project_faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_project_id');
            $table->string('question');
            $table->text('answer');
            $table->integer('order_index')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('research_project_id')->references('id')->on('research_projects')->onDelete('cascade');
            $table->index(['research_project_id', 'status', 'order_index']);
        });

        // Resources/Documents Table
        Schema::create('research_project_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_project_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable(); // pdf, doc, xlsx, etc.
            $table->string('file_size')->nullable();
            $table->string('external_url')->nullable();
            $table->integer('download_count')->default(0);
            $table->integer('order_index')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('research_project_id')->references('id')->on('research_projects')->onDelete('cascade');
            $table->index(['research_project_id', 'status', 'order_index']);
        });

        // Statistics/Highlights Table
        Schema::create('research_project_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_project_id');
            $table->string('label');
            $table->string('value');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable(); // for custom styling
            $table->integer('order_index')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('research_project_id')->references('id')->on('research_projects')->onDelete('cascade');
            $table->index(['research_project_id', 'status', 'order_index']);
        });

        // Workflow Steps Table
        Schema::create('research_project_workflow_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_project_id');
            $table->string('title');
            $table->text('description');
            $table->integer('step_number');
            $table->string('icon')->nullable();
            $table->string('estimated_time')->nullable();
            $table->text('requirements')->nullable(); // JSON array of requirements
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('research_project_id')->references('id')->on('research_projects')->onDelete('cascade');
            $table->index(['research_project_id', 'status', 'step_number']);
        });

        // Functions/Services Table
        Schema::create('research_project_functions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('research_project_id');
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->text('features')->nullable(); // JSON array of features
            $table->integer('order_index')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('research_project_id')->references('id')->on('research_projects')->onDelete('cascade');
            $table->index(['research_project_id', 'status', 'order_index']);
        });

        // Add new columns to existing research_projects table
        Schema::table('research_projects', function (Blueprint $table) {
            $table->text('subtitle')->nullable()->after('title');
            $table->text('hero_description')->nullable()->after('subtitle');
            $table->string('hero_image')->nullable()->after('hero_description');
            $table->text('contact_info')->nullable(); // JSON for contact details
            $table->text('office_hours')->nullable();
            $table->string('office_address')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('office_email')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop new tables
        Schema::dropIfExists('research_project_functions');
        Schema::dropIfExists('research_project_workflow_steps');
        Schema::dropIfExists('research_project_statistics');
        Schema::dropIfExists('research_project_resources');
        Schema::dropIfExists('research_project_faqs');
        Schema::dropIfExists('research_project_team_members');

        // Remove added columns from research_projects table
        Schema::table('research_projects', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle',
                'hero_description', 
                'hero_image',
                'contact_info',
                'office_hours',
                'office_address',
                'office_phone',
                'office_email',
                'meta_description',
                'meta_keywords'
            ]);
        });
    }
};