<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\Schedule;

class ScheduleEditComponent extends Component
{
    public $scheduleId;
    public $name;
    public $description;
    public $channel;
    public $timeZone;
    public $startTime;
    public $endTime;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'channel' => 'required|string',
        'timeZone' => 'required|string',
        'startTime' => 'required|date',
        'endTime' => 'required|date|after:startTime',
    ];

    public function mount($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $this->scheduleId = $schedule->id;
        $this->name = $schedule->name;
        $this->description = $schedule->description;
        $this->channel = $schedule->channel;
        $this->timeZone = $schedule->time_zone;
        $this->startTime = $schedule->start_time;
        $this->endTime = $schedule->end_time;
    }

    public function updateSchedule()
    {
        $this->validate();

        $schedule = Schedule::findOrFail($this->scheduleId);
        $schedule->update([
            'name' => $this->name,
            'description' => $this->description,
            'channel' => $this->channel,
            'time_zone' => $this->timeZone,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
        ]);

        session()->flash('message', 'Schedule updated successfully.');
    }

    public function render()
    {
        return view('livewire.scheduling-automation.schedule-edit-component')
        ->layout('layouts.app');
    }
}