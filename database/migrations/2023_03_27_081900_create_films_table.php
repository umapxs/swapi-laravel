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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Unknown');
            $table->integer('episode_id')->default(0);
            $table->mediumText('opening_crawl')->nullable();
            $table->string('director')->default('Unknown');
            $table->string('producer')->default('Unknown');
            $table->date('release_date')->default('1977-05-25');
            $table->json('characters')->nullable();
            $table->json('planets')->nullable();
            $table->json('starships')->nullable();
            $table->json('vehicles')->nullable();
            $table->json('species')->nullable();
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
        Schema::dropIfExists('films');
    }
};
