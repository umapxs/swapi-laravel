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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Unknown');
            $table->string('height')->default('0');
            $table->string('mass')->default('0');
            $table->string('hair_color')->default('Unknown');
            $table->string('skin_color')->default('Unknown');
            $table->string('eye_color')->default('Unknown');
            $table->string('birth_year')->default('Unknown');
            $table->string('gender')->default('Unknown');
            $table->string('homeworld')->default('Unknown');
            $table->json('films')->nullable();
            $table->json('species')->nullable();
            $table->json('vehicles')->nullable();
            $table->json('starships')->nullable();
            $table->string('created')->default('Unknown');
            $table->string('edited')->default('Unknown');
            $table->string('url')->default('Unknown');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
