<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('leaderboard_id')->unsigned();
            $table->bigInteger('player_id')->unsigned();
            $table->integer('score');
            $table->timestamps();

            $table->foreign('leaderboard_id')->references('id')->on('leaderboards')->onDelete('CASCADE');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
};
