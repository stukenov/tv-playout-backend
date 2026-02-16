<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Channel;

class ManageChannelStatus extends Component
{
    public $channelId;
    public $status;

    protected $rules = [
        'status' => 'required|in:active,inactive,archived',
    ];

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $channel = Channel::findOrFail($channelId);
        $this->status = $channel->status;
    }

    public function updateStatus()
    {
        $this->validate();

        $channel = Channel::findOrFail($this->channelId);
        $channel->status = $this->status;
        $channel->save();

        session()->flash('message', 'Channel status updated successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.manage-channel-status', [
            'channel' => Channel::findOrFail($this->channelId),
        ])->layout('layouts.app');
    }
}