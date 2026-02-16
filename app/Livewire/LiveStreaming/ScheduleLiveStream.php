<?php

namespace App\Livewire\LiveStreaming;

use Livewire\Component;
use App\Models\LiveStream;
use App\Models\Schedule;
use App\Jobs\StartScheduledStream;
use Illuminate\Support\Facades\Auth;

class ScheduleLiveStream extends Component
{
    public $streamId;
    public $scheduledDate;
    public $scheduledTime;
    public $duration;

    protected $rules = [
        'streamId' => 'required|exists:live_streams,id',
        'scheduledDate' => 'required|date|after_or_equal:today',
        'scheduledTime' => 'required',
        'duration' => 'required|integer|min:1|max:720',
    ];

    public function scheduleStream()
    {
        $this->validate();

        $scheduledDateTime = $this->scheduledDate . ' ' . $this->scheduledTime;

        $schedule = Schedule::create([
            'user_id' => Auth::id(),
            'live_stream_id' => $this->streamId,
            'scheduled_start' => $scheduledDateTime,
            'duration' => $this->duration,
        ]);

        StartScheduledStream::dispatch($schedule->id)->delay($schedule->scheduled_start);

        $this->reset(['streamId', 'scheduledDate', 'scheduledTime', 'duration']);
        $this->dispatch('stream-scheduled');
    }

    public function render()
    {
        $streams = LiveStream::where('user_id', Auth::id())->get();
        return view('livewire.live-streaming.schedule-live-stream', compact('streams'))->layout('layouts.app');
    }
}