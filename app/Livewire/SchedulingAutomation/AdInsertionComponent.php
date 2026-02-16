<?php

namespace App\Livewire\SchedulingAutomation;

use Livewire\Component;
use App\Models\AdRule;

class AdInsertionComponent extends Component
{
    public $adRules;
    public $newRule = [
        'criteria' => '',
        'frequency' => '',
    ];

    protected $rules = [
        'newRule.criteria' => 'required|string|max:255',
        'newRule.frequency' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $this->adRules = AdRule::all(); // Assuming an AdRule model exists
    }

    public function addRule()
    {
        $this->validate();

        AdRule::create($this->newRule);

        session()->flash('message', 'Ad rule added successfully.');

        $this->reset('newRule');
        $this->adRules = AdRule::all();
    }

    public function render()
    {
        return view('livewire.scheduling-automation.ad-insertion-component', [
            'adRules' => $this->adRules,
        ])->layout('layouts.app');
    }
}