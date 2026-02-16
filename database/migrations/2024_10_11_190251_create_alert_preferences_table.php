<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alert_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->float('threshold');
            $table->enum('notification_method', ['email', 'sms', 'in-app']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alert_preferences');
    }
};