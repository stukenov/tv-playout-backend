<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\ChannelSetting;
use App\Models\Channel;

class ConfigureChannel extends Component
{
    public $channelId;
    public $resolution;
    public $bitrate;
    public $encodingFormat;

    protected $rules = [
        'resolution' => 'required|string',
        'bitrate' => 'required|integer',
        'encodingFormat' => 'required|string',
    ];

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $settings = ChannelSetting::where('channel_id', $channelId)->first();

        if ($settings) {
            $this->resolution = $settings->resolution;
            $this->bitrate = $settings->bitrate;
            $this->encodingFormat = $settings->encoding_format;
        }
    }

    public function saveSettings()
    {
        $this->validate();

        ChannelSetting::updateOrCreate(
            ['channel_id' => $this->channelId],
            [
                'resolution' => $this->resolution,
                'bitrate' => $this->bitrate,
                'encoding_format' => $this->encodingFormat,
            ]
        );

        session()->flash('message', 'Channel settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.configure-channel', [
            'channel' => Channel::findOrFail($this->channelId),
        ])->layout('layouts.app');
    }
}