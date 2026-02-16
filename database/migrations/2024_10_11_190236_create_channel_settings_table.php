<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('channel_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained('channels');
            $table->string('resolution');
            $table->integer('bitrate');
            $table->string('encoding_format');
            $table->json('default_schedule_parameters')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channel_settings');
    }
}