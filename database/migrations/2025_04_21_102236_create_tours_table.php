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
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('highlights')->nullable();
            $table->text('itinerary')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration')->comment('in days');
            $table->string('location');
            $table->string('image')->nullable();
            $table->string('difficulty')->default('easy')->comment('easy, moderate, challenging');
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
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
