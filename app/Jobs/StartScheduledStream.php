<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Schedule;

class StartScheduledStream implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduleId;

    public function __construct($scheduleId)
    {
        $this->scheduleId = $scheduleId;
    }

    public function handle()
    {
        $schedule = Schedule::findOrFail($this->scheduleId);
        $stream = $schedule->liveStream;

        if ($stream->status !== 'live') {
            $stream->update(['status' => 'live']);
        }
    }
}