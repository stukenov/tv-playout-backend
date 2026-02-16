<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Channel;

class SelectiveClone extends Component
{
    public $channelId;
    public $newChannelName;
    public $cloneBranding = false;
    public $cloneSchedule = false;
    public $cloneContent = false;

    protected $rules = [
        'newChannelName' => 'required|string|max:255',
    ];

    public function cloneChannel()
    {
        $this->validate();

        $originalChannel = Channel::findOrFail($this->channelId);

        $newChannel = $originalChannel->replicate();
        $newChannel->name = $this->newChannelName;

        if (!$this->cloneBranding) {
            $newChannel->branding_assets = null;
        }

        if (!$this->cloneSchedule) {
            $newChannel->schedule = null; // Assuming schedule is a property
        }

        if (!$this->cloneContent) {
            $newChannel->content = null; // Assuming content is a property
        }

        $newChannel->save();

        session()->flash('message', 'Channel selectively cloned successfully.');

        return redirect()->route('channels.index');
    }

    public function render()
    {
        return view('livewire.channel-management.selective-clone', [
            'channel' => Channel::findOrFail($this->channelId),
        ])->layout('layouts.app');
    }
}