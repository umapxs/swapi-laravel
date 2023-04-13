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
        Schema::create('people_starships_films', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('people_id')->constrained();
            $table->unsignedBigInteger('people_id')->nullable();
            $table->foreignId('starships_id')->nullable()->constrained();
            $table->foreignId('films_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people_starships_films');
    }
};
