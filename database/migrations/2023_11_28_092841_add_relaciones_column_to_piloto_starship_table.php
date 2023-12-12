<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelacionesColumnToPilotoStarshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('piloto_starship', function (Blueprint $table) {
            $table->string('starship_name')->nullable();
            $table->string('piloto_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('piloto_starship', function (Blueprint $table) {
            $table->dropColumn('starship_name');
            $table->dropColumn('piloto_name');
        });
    }
}

