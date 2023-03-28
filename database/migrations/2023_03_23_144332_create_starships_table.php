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
        Schema::create('starships', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Unknown');
            $table->string('model')->default('Unknown');
            $table->string('manufacturer')->default('Unknown');
            $table->string('cost_in_credits')->default('0');
            $table->string('length')->default('0');
            $table->string('max_atmosphering_speed')->default('0');
            $table->string('crew')->default('0');
            $table->string('passengers')->default('0');
            $table->string('cargo_capacity')->default('0');
            $table->string('consumables')->default('0');
            $table->string('hyperdrive_rating')->default('0');
            $table->string('MGLT')->default('0');
            $table->string('starship_class')->default('Unknown');
            $table->json('pilots')->nullable();
            $table->json('films')->nullable();
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
        Schema::dropIfExists('starships');
    }
};
