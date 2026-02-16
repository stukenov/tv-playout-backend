<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Channel;

class CustomizeBranding extends Component
{
    use WithFileUploads;

    public $channelId;
    public $logo;
    public $banner;
    public $colorScheme;

    protected $rules = [
        'logo' => 'nullable|image|max:1024', // 1MB Max
        'banner' => 'nullable|image|max:2048', // 2MB Max
        'colorScheme' => 'nullable|string',
    ];

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $channel = Channel::findOrFail($channelId);

        $this->colorScheme = $channel->branding_assets['color_scheme'] ?? '';
    }

    public function saveBranding()
    {
        $this->validate();

        $channel = Channel::findOrFail($this->channelId);

        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
            $channel->branding_assets['logo'] = $logoPath;
        }

        if ($this->banner) {
            $bannerPath = $this->banner->store('banners', 'public');
            $channel->branding_assets['banner'] = $bannerPath;
        }

        $channel->branding_assets['color_scheme'] = $this->colorScheme;
        $channel->save();

        session()->flash('message', 'Branding updated successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.customize-branding', [
            'channel' => Channel::findOrFail($this->channelId),
        ])->layout('layouts.app');
    }
}