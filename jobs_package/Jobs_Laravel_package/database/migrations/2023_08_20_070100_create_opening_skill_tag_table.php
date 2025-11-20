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
        Schema::create('opening_skill_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opening_id')->constrained('openings')->cascadeOnDelete();
            $table->foreignId('skill_tag_id')->constrained('skill_tags')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['opening_id', 'skill_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opening_skill_tag');
    }
};
