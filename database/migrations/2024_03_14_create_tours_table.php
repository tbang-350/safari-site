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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('duration')->comment('Duration in days');
            $table->decimal('price', 10, 2);
            $table->enum('image_type', ['pexels', 'custom'])->default('custom');
            $table->string('image_source')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('max_people')->nullable();
            $table->string('location');
            $table->enum('difficulty_level', ['easy', 'moderate', 'challenging'])->default('moderate');
            $table->json('included_services')->nullable();
            $table->json('excluded_services')->nullable();
            $table->json('itinerary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
