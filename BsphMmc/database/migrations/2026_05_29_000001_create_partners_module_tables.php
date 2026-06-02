<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Partners Page Settings
        Schema::create('partners_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->default('Building Excellence Through Partnerships');
            $table->string('hero_subtitle')->default('Global Collaboration for Healthcare Excellence');
            $table->string('hero_banner_image_url')->nullable();
            $table->longText('overview_content')->nullable();
            $table->timestamps();
        });

        // Partner Categories
        Schema::create('partner_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        // Partners
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo_image_url')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('partner_categories')->nullOnDelete();
            $table->string('website_url')->nullable();
            $table->integer('partnership_year')->nullable();
            $table->string('collaboration_type')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Partnership Statistics
        Schema::create('partnership_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('value');
            $table->string('icon_class')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Partnership Areas (Collaboration Areas)
        Schema::create('partnership_areas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon_class')->nullable();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Success Stories / Highlights
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image_url')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Partnership Documents (MoUs, Agreements, Reports)
        Schema::create('partnership_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('file_url');
            $table->string('document_category')->nullable();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Partnership Contact Information
        Schema::create('partnership_contact_info', function (Blueprint $table) {
            $table->id();
            $table->string('office_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('office_hours')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });

        // Featured Partners (Order/Selection)
        Schema::create('featured_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('partners')->cascadeOnDelete();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_partners');
        Schema::dropIfExists('partnership_contact_info');
        Schema::dropIfExists('partnership_documents');
        Schema::dropIfExists('success_stories');
        Schema::dropIfExists('partnership_areas');
        Schema::dropIfExists('partnership_statistics');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('partner_categories');
        Schema::dropIfExists('partners_pages');
    }
};
