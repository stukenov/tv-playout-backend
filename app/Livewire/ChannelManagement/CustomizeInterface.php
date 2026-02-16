<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Channel;

class CustomizeInterface extends Component
{
    public $channelId;
    public $uiSettings = [];

    protected $rules = [
        'uiSettings.*' => 'nullable|string',
    ];

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $channel = Channel::findOrFail($channelId);

        $this->uiSettings = $channel->ui_settings ?? [];
    }

    public function saveInterfaceSettings()
    {
        $this->validate();

        $channel = Channel::findOrFail($this->channelId);
        $channel->ui_settings = $this->uiSettings;
        $channel->save();

        session()->flash('message', 'Interface settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.customize-interface', [
            'channel' => Channel::findOrFail($this->channelId),
        ])->layout('layouts.app');
    }
}