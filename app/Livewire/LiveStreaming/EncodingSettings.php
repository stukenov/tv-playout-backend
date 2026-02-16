<?php

namespace App\Livewire\LiveStreaming;

use Livewire\Component;
use App\Models\EncodingSetting;
use Illuminate\Support\Facades\Auth;

class EncodingSettings extends Component
{
    public $videoCodec = 'h264';
    public $audioCodec = 'aac';
    public $resolution = '1080p';
    public $bitrate = '5000';
    public $framerate = '30';

    protected $rules = [
        'videoCodec' => 'required|in:h264,h265,vp9',
        'audioCodec' => 'required|in:aac,opus',
        'resolution' => 'required|in:720p,1080p,1440p,2160p',
        'bitrate' => 'required|integer|min:1000|max:20000',
        'framerate' => 'required|in:24,30,60',
    ];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $settings = EncodingSetting::where('user_id', Auth::id())->first();
        if ($settings) {
            $this->videoCodec = $settings->video_codec;
            $this->audioCodec = $settings->audio_codec;
            $this->resolution = $settings->resolution;
            $this->bitrate = $settings->bitrate;
            $this->framerate = $settings->framerate;
        }
    }

    public function saveSettings()
    {
        $this->validate();

        EncodingSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'video_codec' => $this->videoCodec,
                'audio_codec' => $this->audioCodec,
                'resolution' => $this->resolution,
                'bitrate' => $this->bitrate,
                'framerate' => $this->framerate,
            ]
        );

        $this->dispatch('settings-saved');
    }

    public function render()
    {
        return view('livewire.live-streaming.encoding-settings')->layout('layouts.app');
    }
}