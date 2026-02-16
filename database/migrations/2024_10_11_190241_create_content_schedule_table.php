<?php
    
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('content_schedule', function (Blueprint $table) {
        $table->id();
        $table->foreignId('content_id')->constrained()->onDelete('cascade');
        $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
        $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('content_schedule');
    }
}