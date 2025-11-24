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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Room name (e.g., "Tipe A - 101")
            $table->string('type'); // Room type (e.g., "Tipe A", "Tipe B")
            $table->integer('price'); // Monthly price in IDR
            $table->integer('capacity'); // Number of people (1, 2, etc.)
            $table->string('size'); // Room size (e.g., "3×4m")
            $table->json('facilities'); // Array of facilities
            $table->boolean('is_available')->default(true); // Availability status
            $table->string('image')->nullable(); // Image path/URL
            $table->text('description')->nullable(); // Optional description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
