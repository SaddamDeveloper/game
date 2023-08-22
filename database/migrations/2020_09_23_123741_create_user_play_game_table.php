<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPlayGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_play_game', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('game_play_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_details_id');
            $table->char('is_win')->comment('1=No,2=Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_play_game');
    }
}
