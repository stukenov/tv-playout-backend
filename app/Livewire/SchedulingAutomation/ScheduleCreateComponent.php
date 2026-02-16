<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\Schedule;

class ScheduleCreateComponent extends Component
{
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

    public function createSchedule()
    {
        $this->validate();

        Schedule::create([
            'name' => $this->name,
            'description' => $this->description,
            'channel' => $this->channel,
            'time_zone' => $this->timeZone,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
        ]);

        session()->flash('message', 'Schedule created successfully.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.scheduling-automation.schedule-create-component')
        ->layout('layouts.app');
    }
}