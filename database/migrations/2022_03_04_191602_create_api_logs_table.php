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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('uri');
            $table->string('method');
            $table->string('ip');
            $table->longText('request_headers')->nullable()->default(null);
            $table->longText('request_body')->nullable()->default(null);
            $table->integer('response_code');
            $table->longText('response_headers')->nullable()->default(null);
            $table->longText('response_body')->nullable()->default(null);
            $table->integer('duration');
            $table->bigInteger('apikey_id')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('apikey_id')->references('id')->on('api_keys')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_logs');
    }
};
