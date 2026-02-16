<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Channel;

class CreateChannel extends Component
{
    public $name;
    public $description;
    public $category;
    public $language;
    public $targetAudience;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category' => 'required|string',
        'language' => 'required|string',
        'targetAudience' => 'nullable|string',
    ];

    public function createChannel()
    {
        $this->validate();

        Channel::create([
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'language' => $this->language,
            'target_audience' => $this->targetAudience,
        ]);

        session()->flash('message', 'Channel created successfully.');

        return redirect()->route('channels.index');
    }

    public function render()
    {
        return view('livewire.channel-management.create-channel')->layout('layouts.app');
    }
}