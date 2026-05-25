<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mission_vision', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'mission' or 'vision'
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('core_values', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('core_values');
        Schema::dropIfExists('mission_vision');
    }
};
