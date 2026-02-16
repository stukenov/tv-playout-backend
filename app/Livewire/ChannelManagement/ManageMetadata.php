<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Channel;

class ManageMetadata extends Component
{
    public $channelId;
    public $seoTitle;
    public $seoDescription;
    public $tags = [];

    protected $rules = [
        'seoTitle' => 'required|string|max:255',
        'seoDescription' => 'nullable|string',
        'tags' => 'nullable|array',
    ];

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $channel = Channel::findOrFail($channelId);

        $this->seoTitle = $channel->metadata['seo_title'] ?? '';
        $this->seoDescription = $channel->metadata['seo_description'] ?? '';
        $this->tags = $channel->metadata['tags'] ?? [];
    }

    public function saveMetadata()
    {
        $this->validate();

        $channel = Channel::findOrFail($this->channelId);
        $channel->metadata = [
            'seo_title' => $this->seoTitle,
            'seo_description' => $this->seoDescription,
            'tags' => $this->tags,
        ];
        $channel->save();

        session()->flash('message', 'Metadata updated successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.manage-metadata', [
            'channel' => Channel::findOrFail($this->channelId),
        ])->layout('layouts.app');
    }
}