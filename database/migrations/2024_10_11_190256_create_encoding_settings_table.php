<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('encoding_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('video_codec');
            $table->string('audio_codec');
            $table->string('resolution');
            $table->integer('bitrate');
            $table->integer('framerate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('encoding_settings');
    }
};