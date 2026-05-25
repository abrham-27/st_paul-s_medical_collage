<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_research_publications', function (Blueprint $table) {
            $table->id();
            $table->string('school_type');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->longText('abstract')->nullable();
            $table->string('authors')->nullable();
            $table->string('publication_type')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('journal_name')->nullable();
            $table->string('doi_link')->nullable();
            $table->string('external_link')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('keywords')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_research_publications');
    }
};
