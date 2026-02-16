<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Content;
use App\Models\Channel;

class ContentIntegration extends Component
{
    public $channelId;
    public $contents;
    public $selectedContent;

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $this->contents = Content::all();
    }

    public function assignContent()
    {
        $this->validate([
            'selectedContent' => 'required|exists:contents,id',
        ]);

        $channel = Channel::findOrFail($this->channelId);
        $channel->contents()->attach($this->selectedContent);

        session()->flash('message', 'Content assigned successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.content-integration', [
            'channelContents' => Channel::findOrFail($this->channelId)->contents,
        ])->layout('layouts.app');
    }
}