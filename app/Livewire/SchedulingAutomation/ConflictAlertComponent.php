<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\Schedule;

class ConflictAlertComponent extends Component
{
    public $conflicts = [];

    public function checkConflicts()
    {
        // Logic to detect conflicts
        $schedules = Schedule::all();
        foreach ($schedules as $schedule) {
            foreach ($schedules as $otherSchedule) {
                if ($schedule->id !== $otherSchedule->id && $this->isOverlapping($schedule, $otherSchedule)) {
                    $this->conflicts[] = "Conflict between {$schedule->name} and {$otherSchedule->name}";
                }
            }
        }
    }

    private function isOverlapping($schedule1, $schedule2)
    {
        return $schedule1->start_time < $schedule2->end_time && $schedule1->end_time > $schedule2->start_time;
    }

    public function render()
    {
        return view('livewire.scheduling-automation.conflict-alert-component', [
            'conflicts' => $this->conflicts,
        ])->layout('layouts.app');
    }
}