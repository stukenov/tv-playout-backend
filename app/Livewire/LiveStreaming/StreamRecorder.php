<?php

namespace App\Livewire\LiveStreaming;

use Livewire\Component;
use App\Models\LiveStream;
use App\Models\StreamRecording;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;

class StreamRecorder extends Component
{
    public $activeStreams;
    public $recordings;
    public $selectedStreamId;
    public $isRecording = false;

    public function mount()
    {
        $this->loadActiveStreams();
        $this->loadRecordings();
    }

    public function loadActiveStreams()
    {
        $this->activeStreams = LiveStream::where('user_id', Auth::id())
            ->where('status', 'live')
            ->get();
    }

    public function loadRecordings()
    {
        $this->recordings = StreamRecording::where('user_id', Auth::id())
            ->with('liveStream')
            ->latest()
            ->get();
    }

    public function startRecording()
    {
        if (!$this->selectedStreamId) {
            return;
        }

        $recording = StreamRecording::create([
            'user_id' => Auth::id(),
            'live_stream_id' => $this->selectedStreamId,
            'status' => 'recording',
        ]);

        $this->isRecording = true;
        $this->dispatch('recording-started');
    }

    public function stopRecording()
    {
        $recording = StreamRecording::where('live_stream_id', $this->selectedStreamId)
            ->where('status', 'recording')
            ->first();

        if ($recording) {
            $recording->update(['status' => 'completed']);
            $this->isRecording = false;
            $this->loadRecordings();
            $this->dispatch('recording-stopped');
        }
    }

    public function addToVOD($recordingId)
    {
        $recording = StreamRecording::findOrFail($recordingId);
        
        // Create a new Content entry in the CMS
        $content = Content::create([
            'user_id' => Auth::id(),
            'title' => $recording->liveStream->title . ' - Recording',
            'type' => 'vod',
            'source' => 'live_stream_recording',
            'source_id' => $recording->id,
            'duration' => $recording->duration, // You might need to add this field to the StreamRecording model
            'status' => 'processing', // Assuming you have a processing step before it's available
        ]);

        $recording->update([
            'added_to_vod' => true,
            'content_id' => $content->id
        ]);

        $this->loadRecordings();
        $this->dispatch('added-to-vod');
    }

    public function render()
    {
        return view('livewire.live-streaming.stream-recorder')->layout('layouts.app');
    }
}