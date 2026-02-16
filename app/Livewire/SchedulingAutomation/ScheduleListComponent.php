<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\Schedule;

class ScheduleListComponent extends Component
{
    public $schedules;

    public function mount()
    {
        $this->schedules = Schedule::all(); // Fetch all schedules
    }

    public function render()
    {
        return view('livewire.scheduling-automation.schedule-list-component', [
            'schedules' => $this->schedules,
        ])->layout('layouts.app');
    }
}