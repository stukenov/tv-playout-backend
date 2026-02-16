<?php

namespace App\Livewire\LiveStreaming;

use Livewire\Component;
use App\Models\ABRSetting;
use Illuminate\Support\Facades\Auth;

class ABRSettings extends Component
{
    public $enabled = false;
    public $qualities = [
        ['resolution' => '1080p', 'bitrate' => 5000, 'enabled' => true],
        ['resolution' => '720p', 'bitrate' => 2500, 'enabled' => true],
        ['resolution' => '480p', 'bitrate' => 1000, 'enabled' => true],
        ['resolution' => '360p', 'bitrate' => 500, 'enabled' => false],
    ];

    protected $rules = [
        'enabled' => 'boolean',
        'qualities.*.resolution' => 'required|string',
        'qualities.*.bitrate' => 'required|integer|min:100|max:10000',
        'qualities.*.enabled' => 'boolean',
    ];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $settings = ABRSetting::where('user_id', Auth::id())->first();
        if ($settings) {
            $this->enabled = $settings->enabled;
            $this->qualities = $settings->qualities;
        }
    }

    public function saveSettings()
    {
        $this->validate();

        ABRSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'enabled' => $this->enabled,
                'qualities' => $this->qualities,
            ]
        );

        $this->dispatch('settings-saved');
    }

    public function addQuality()
    {
        $this->qualities[] = ['resolution' => '', 'bitrate' => 1000, 'enabled' => true];
    }

    public function removeQuality($index)
    {
        unset($this->qualities[$index]);
        $this->qualities = array_values($this->qualities);
    }

    public function render()
    {
        return view('livewire.live-streaming.abr-settings');
    }
}