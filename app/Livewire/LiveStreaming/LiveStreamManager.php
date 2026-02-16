<?php

namespace App\Livewire\LiveStreaming;

use Livewire\Component;
use App\Models\LiveStream;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LiveStreamManager extends Component
{
    public $streams;
    public $scheduledStreams;
    public $newStreamTitle = '';
    public $newStreamDescription = '';

    protected $rules = [
        'newStreamTitle' => 'required|min:3|max:255',
        'newStreamDescription' => 'nullable|max:1000',
    ];

    public function mount()
    {
        $this->loadStreams();
        $this->loadScheduledStreams();
    }

    public function loadStreams()
    {
        $this->streams = LiveStream::where('user_id', Auth::id())->latest()->get();
    }

    public function loadScheduledStreams()
    {
        $this->scheduledStreams = Schedule::where('user_id', Auth::id())
            ->where('scheduled_start', '>=', Carbon::now())
            ->with('liveStream')
            ->orderBy('scheduled_start')
            ->get();
    }

    public function startStream()
    {
        $this->validate();

        LiveStream::create([
            'user_id' => Auth::id(),
            'title' => $this->newStreamTitle,
            'description' => $this->newStreamDescription,
            'status' => 'live',
        ]);

        $this->reset(['newStreamTitle', 'newStreamDescription']);
        $this->loadStreams();
        $this->dispatch('stream-started');
    }

    public function stopStream($streamId)
    {
        $stream = LiveStream::findOrFail($streamId);
        $stream->update(['status' => 'ended']);
        $this->loadStreams();
        $this->dispatch('stream-stopped');
    }

    public function startScheduledStream($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $stream = $schedule->liveStream;

        if ($stream->status !== 'live') {
            $stream->update(['status' => 'live']);
            $this->loadStreams();
            $this->loadScheduledStreams();
            $this->dispatch('scheduled-stream-started');
        }
    }

    public function render()
    {
        return view('livewire.live-streaming.live-stream-manager');
    }
}