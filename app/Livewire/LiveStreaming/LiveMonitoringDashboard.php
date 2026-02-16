<?php

namespace App\Livewire\LiveStreaming;

use Livewire\Component;
use App\Models\LiveStream;
use Illuminate\Support\Facades\Auth;

class LiveMonitoringDashboard extends Component
{
    public $activeStreams;
    public $selectedStreamId;
    public $streamMetrics = [];

    public function mount()
    {
        $this->loadActiveStreams();
    }

    public function loadActiveStreams()
    {
        $this->activeStreams = LiveStream::where('user_id', Auth::id())
            ->where('status', 'live')
            ->get();

        if ($this->activeStreams->isNotEmpty() && !$this->selectedStreamId) {
            $this->selectedStreamId = $this->activeStreams->first()->id;
        }
    }

    public function getStreamMetrics()
    {
        // In a real-world scenario, you would fetch these metrics from your streaming server or third-party service
        // For this example, we'll generate random data
        $this->streamMetrics = [
            'bitrate' => rand(2000, 8000),
            'framerate' => rand(24, 60),
            'latency' => rand(1000, 5000) / 1000,
            'errors' => rand(0, 10),
        ];
    }

    public function render()
    {
        if ($this->selectedStreamId) {
            $this->getStreamMetrics();
        }

        return view('livewire.live-streaming.live-monitoring-dashboard')->layout('layouts.app');
        
    }
}