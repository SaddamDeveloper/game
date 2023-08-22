<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->date('dob')->nullable();
            $table->string('api_token',256)->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('pin')->nullable();
            $table->char('gender')->comment('M=male, F=Female')->nullabele();
            $table->string('address')->nullable();
            $table->rememberToken();
            $table->char('status')->comment('1=Enable, 2=Disable');
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
        Schema::dropIfExists('user');
    }
}
