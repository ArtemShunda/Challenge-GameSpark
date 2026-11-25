<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('image_path');
            $table->string('platform', 40);
            $table->string('genre', 40);
            $table->unsignedSmallInteger('release_year');
            $table->string('status', 30);
            $table->decimal('rating', 3, 1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
