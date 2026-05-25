<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->enum('area', ['local', 'international'])->default('local');
            $table->string('featured_image')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $legacy = DB::table('academic_pages')
            ->where('school_type', 'medicine')
            ->where('page_type', 'partnership')
            ->first();

        if ($legacy && (!empty($legacy->title) || !empty($legacy->content))) {
            $slug = Str::slug($legacy->title ?: 'partnership-' . $legacy->id);
            if (DB::table('medicine_partnerships')->where('slug', $slug)->exists()) {
                $slug .= '-' . $legacy->id;
            }

            DB::table('medicine_partnerships')->insert([
                'title' => $legacy->title ?: 'Partnership',
                'slug' => $slug,
                'content' => $legacy->content,
                'area' => 'local',
                'featured_image' => $legacy->featured_image,
                'display_order' => 0,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('medicine_partnerships');
    }
};
