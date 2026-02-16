<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Channel;

class CloneChannel extends Component
{
    public $channelId;
    public $newChannelName;

    protected $rules = [
        'newChannelName' => 'required|string|max:255',
    ];

    public function cloneChannel()
    {
        $this->validate();

        $originalChannel = Channel::findOrFail($this->channelId);

        $newChannel = $originalChannel->replicate();
        $newChannel->name = $this->newChannelName;
        $newChannel->save();

        session()->flash('message', 'Channel cloned successfully.');

        return redirect()->route('channels.index');
    }

    public function render()
    {
        return view('livewire.channel-management.clone-channel', [
            'channel' => Channel::findOrFail($this->channelId),
        ])->layout('layouts.app');
    }
}