<?php

namespace App\Livewire\DistributionManagement;

use Livewire\Component;
use App\Models\AlertPreference;
use Illuminate\Support\Facades\Auth;

class AlertingSystemComponent extends Component
{
    public $alertPreferences;
    public $newAlert = [
        'type' => '',
        'threshold' => null,
        'notification_method' => 'email',
    ];

    protected $rules = [
        'newAlert.type' => 'required|string',
        'newAlert.threshold' => 'required|numeric',
        'newAlert.notification_method' => 'required|in:email,sms,in-app',
    ];

    public function mount()
    {
        $this->loadAlertPreferences();
    }

    public function loadAlertPreferences()
    {
        $this->alertPreferences = AlertPreference::where('user_id', Auth::id())->get();
    }

    public function saveAlertPreference()
    {
        $this->validate();

        AlertPreference::create([
            'user_id' => Auth::id(),
            'type' => $this->newAlert['type'],
            'threshold' => $this->newAlert['threshold'],
            'notification_method' => $this->newAlert['notification_method'],
        ]);

        $this->reset('newAlert');
        $this->loadAlertPreferences();
        session()->flash('message', 'Alert preference added successfully.');
    }

    public function deleteAlertPreference($alertId)
    {
        AlertPreference::destroy($alertId);
        $this->loadAlertPreferences();
        session()->flash('message', 'Alert preference deleted successfully.');
    }

    public function render()
    {
        return view('livewire.distribution-management.alerting-system')->layout('layouts.app');
    }
}