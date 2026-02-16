<?php

namespace App\Livewire\ChannelManagement;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\Channel;

class ScheduleIntegration extends Component
{
    public $channelId;
    public $schedules;
    public $selectedSchedule;

    public function mount($channelId)
    {
        $this->channelId = $channelId;
        $this->schedules = Schedule::all();
    }

    public function assignSchedule()
    {
        $this->validate([
            'selectedSchedule' => 'required|exists:schedules,id',
        ]);

        $channel = Channel::findOrFail($this->channelId);
        $channel->schedules()->attach($this->selectedSchedule);

        session()->flash('message', 'Schedule assigned successfully.');
    }

    public function render()
    {
        return view('livewire.channel-management.schedule-integration', [
            'channelSchedules' => Channel::findOrFail($this->channelId)->schedules,
        ]);
    }
}