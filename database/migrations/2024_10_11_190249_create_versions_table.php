<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained()->onDelete('cascade');
            $table->integer('version_number');
            $table->string('file_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('versions');
    }
};