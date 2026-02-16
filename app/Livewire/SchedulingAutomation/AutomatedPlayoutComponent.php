<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\Schedule;

class AutomatedPlayoutComponent extends Component
{
    public $schedules;
    public $status = [];

    public function mount()
    {
        $this->schedules = Schedule::all();
        foreach ($this->schedules as $schedule) {
            $this->status[$schedule->id] = 'stopped'; // Initial status
        }
    }

    public function start($scheduleId)
    {
        $this->status[$scheduleId] = 'running';
        session()->flash('message', "Automated playout for schedule {$scheduleId} started.");
    }

    public function stop($scheduleId)
    {
        $this->status[$scheduleId] = 'stopped';
        session()->flash('message', "Automated playout for schedule {$scheduleId} stopped.");
    }

    public function render()
    {
        return view('livewire.scheduling-automation.automated-playout-component', [
            'schedules' => $this->schedules,
            'status' => $this->status,
        ])->layout('layouts.app');
    }
}