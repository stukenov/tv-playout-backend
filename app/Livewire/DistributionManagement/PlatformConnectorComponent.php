<?php

namespace App\Livewire\DistributionManagement;

use Livewire\Component;
use App\Models\Platform;
use Illuminate\Support\Facades\Crypt;

class PlatformConnectorComponent extends Component
{
    public $platforms;
    public $newPlatform = [
        'name' => '',
        'type' => '',
        'api_endpoint' => '',
        'credentials' => '',
    ];
    public $editingPlatform = null;

    protected $rules = [
        'newPlatform.name' => 'required|string|max:255',
        'newPlatform.type' => 'required|string|max:255',
        'newPlatform.api_endpoint' => 'required|url',
        'newPlatform.credentials' => 'required|string',
    ];

    public function mount()
    {
        $this->loadPlatforms();
    }

    public function loadPlatforms()
    {
        $this->platforms = Platform::all();
    }

    public function savePlatform()
    {
        $this->validate();

        $platform = new Platform($this->newPlatform);
        $platform->credentials = Crypt::encryptString($this->newPlatform['credentials']);
        $platform->save();

        $this->reset('newPlatform');
        $this->loadPlatforms();
        session()->flash('message', 'Platform added successfully.');
    }

    public function editPlatform($platformId)
    {
        $this->editingPlatform = Platform::findOrFail($platformId);
        $this->newPlatform = $this->editingPlatform->toArray();
        $this->newPlatform['credentials'] = Crypt::decryptString($this->editingPlatform->credentials);
    }

    public function updatePlatform()
    {
        $this->validate();

        $this->editingPlatform->update([
            'name' => $this->newPlatform['name'],
            'type' => $this->newPlatform['type'],
            'api_endpoint' => $this->newPlatform['api_endpoint'],
            'credentials' => Crypt::encryptString($this->newPlatform['credentials']),
        ]);

        $this->reset(['newPlatform', 'editingPlatform']);
        $this->loadPlatforms();
        session()->flash('message', 'Platform updated successfully.');
    }

    public function deletePlatform($platformId)
    {
        Platform::destroy($platformId);
        $this->loadPlatforms();
        session()->flash('message', 'Platform deleted successfully.');
    }

    public function render()
    {
        return view('livewire.distribution-management.platform-connector')->layout('layouts.app');
    }
}