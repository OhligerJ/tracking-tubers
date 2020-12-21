<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_id');
            $table->dateTime('date'); // We won't need to update this; we just need to know which date the subscriber_count was recorded
            $table->unsignedBigInteger('subscriber_count');

            $table->foreign('channel_id')->references('id')->on('channels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_info');
    }
}
