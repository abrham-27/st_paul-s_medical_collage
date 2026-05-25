<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('health_diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('symptoms')->nullable();
            $table->json('prevention')->nullable();
            $table->json('advice')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('specialized_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->string('icon')->nullable();
            $table->string('location')->nullable();
            $table->string('hours')->nullable();
            $table->string('contact')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_diseases');
        Schema::dropIfExists('health_categories');
        Schema::dropIfExists('specialized_centers');
    }
};
