<?php

use App\Models\ScoreType;
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
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('competition_id')->unsigned();
            $table->string('name');
            $table->string('key')->nullable()->default(null);
            $table->boolean('active')->default(false);
            $table->string('score_type')->default(ScoreType::POINTS);
            $table->timestamps();

            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaderboards');
    }
};
