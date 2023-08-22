<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumberColorIdToGameResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_result', function (Blueprint $table) {
            $table->integer('number_game_details_id')->after('game_details_id')->nullable();
            $table->integer('color_game_details_id')->after('number_game_details_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_result', function (Blueprint $table) {
            //
        });
    }
}
