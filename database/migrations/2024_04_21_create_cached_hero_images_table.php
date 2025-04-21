<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cached_hero_images', function (Blueprint $table) {
            $table->id();
            $table->string('pexels_id')->unique();
            $table->text('url');
            $table->string('photographer');
            $table->string('photographer_url');
            $table->string('alt_text');
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cached_hero_images');
    }
};
