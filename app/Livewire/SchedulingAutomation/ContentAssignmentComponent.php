<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\Content;

class ContentAssignmentComponent extends Component
{
    public $schedules;
    public $contents;

    public function mount()
    {
        $this->schedules = Schedule::all();
        $this->contents = Content::all(); // Assuming a Content model exists
    }

    public function assignContent($scheduleId, $contentId)
    {
        $schedule = Schedule::find($scheduleId);
        $content = Content::find($contentId);

        // Logic to assign content to the schedule
        $schedule->contents()->attach($content);

        session()->flash('message', 'Content assigned successfully.');
    }

    public function render()
    {
        return view('livewire.scheduling-automation.content-assignment-component', [
            'schedules' => $this->schedules,
            'contents' => $this->contents,
        ])->layout('layouts.app');
    }
}