<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('stream_recordings', function (Blueprint $table) {
            $table->foreignId('content_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('duration')->nullable(); // Duration in seconds
        });
    }

    public function down()
    {
        Schema::table('stream_recordings', function (Blueprint $table) {
            $table->dropForeign(['content_id']);
            $table->dropColumn(['content_id', 'duration']);
        });
    }
};