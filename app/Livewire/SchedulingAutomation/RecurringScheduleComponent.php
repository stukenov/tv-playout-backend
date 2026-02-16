<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\Schedule;

class RecurringScheduleComponent extends Component
{
    public $name;
    public $description;
    public $channel;
    public $timeZone;
    public $startTime;
    public $endTime;
    public $recurrencePattern;
    public $recurrenceDetails;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'channel' => 'required|string',
        'timeZone' => 'required|string',
        'startTime' => 'required|date',
        'endTime' => 'required|date|after:startTime',
        'recurrencePattern' => 'required|string',
        'recurrenceDetails' => 'nullable|string',
    ];

    public function createRecurringSchedule()
    {
        $this->validate();

        Schedule::create([
            'name' => $this->name,
            'description' => $this->description,
            'channel' => $this->channel,
            'time_zone' => $this->timeZone,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'recurrence_pattern' => $this->recurrencePattern,
            'recurrence_details' => $this->recurrenceDetails,
        ]);

        session()->flash('message', 'Recurring schedule created successfully.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.scheduling-automation.recurring-schedule-component')
        ->layout('layouts.app');
    }
}