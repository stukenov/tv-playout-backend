<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\ChannelRole;
use App\Models\User;

class ChannelAccessControl extends Component
{
    public $channelId;
    public $users;
    public $roles = ['admin', 'editor', 'viewer'];
    public $selectedUser;
    public $selectedRole;

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $this->users = User::all();
    }

    public function assignRole()
    {
        $this->validate([
            'selectedUser' => 'required|exists:users,id',
            'selectedRole' => 'required|in:admin,editor,viewer',
        ]);

        ChannelRole::updateOrCreate(
            ['channel_id' => $this->channelId, 'user_id' => $this->selectedUser],
            ['role' => $this->selectedRole]
        );

        session()->flash('message', 'Role assigned successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.channel-access-control', [
            'channelRoles' => ChannelRole::where('channel_id', $this->channelId)->get(),
        ])->layout('layouts.app');
    }
}