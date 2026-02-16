<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelRolesTable extends Migration
{
    public function up()
    {
        Schema::create('channel_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained('channels');
            $table->foreignId('user_id')->constrained();
            $table->enum('role', ['admin', 'editor', 'viewer'])->default('viewer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channel_roles');
    }
}