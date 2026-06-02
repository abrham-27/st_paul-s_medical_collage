<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_applications', function (Blueprint $table) {
            $table->id();
            $table->string('institution_name');
            $table->string('institution_type')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('website_url')->nullable();
            $table->string('contact_person_name');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('contact_role')->nullable();
            $table->text('collaboration_interests')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'under_review', 'approved', 'declined'])->default('pending');
            $table->text('admin_feedback')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_applications');
    }
};
