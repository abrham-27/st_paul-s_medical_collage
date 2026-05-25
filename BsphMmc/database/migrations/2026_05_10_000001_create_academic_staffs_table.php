<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_staffs', function (Blueprint $table) {
            $table->id();
            $table->enum('school_type', ['medicine', 'nursing', 'public_health']);
            $table->string('full_name');
            $table->string('slug')->unique();
            $table->string('position');
            $table->string('department')->nullable();
            $table->string('profile_image')->nullable();
            $table->text('biography')->nullable();
            $table->string('qualification')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('display_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_staffs');
    }
};
