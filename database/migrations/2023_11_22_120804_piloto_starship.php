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
        Schema::create('piloto_starship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('piloto_id');
            $table->unsignedBigInteger('starship_id');

            // Definir claves foráneas
            $table->foreign('piloto_id')->references('id')->on('pilotos');
            $table->foreign('starship_id')->references('id')->on('starships');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
