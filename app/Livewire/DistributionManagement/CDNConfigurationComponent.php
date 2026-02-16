<?php

namespace App\Livewire\DistributionManagement;

use Livewire\Component;
use App\Models\CDN;
use Illuminate\Support\Facades\Auth;

class CDNConfigurationComponent extends Component
{
    public $cdns;
    public $newCDN = [
        'name' => '',
        'provider' => '',
        'configuration' => '',
    ];
    public $editingCDN = null;

    protected $rules = [
        'newCDN.name' => 'required|string|max:255',
        'newCDN.provider' => 'required|string|max:255',
        'newCDN.configuration' => 'required|json',
    ];

    public function mount()
    {
        $this->loadCDNs();
    }

    public function loadCDNs()
    {
        $this->cdns = CDN::all();
    }

    public function saveCDN()
    {
        $this->validate();

        CDN::create($this->newCDN);

        $this->reset('newCDN');
        $this->loadCDNs();
        session()->flash('message', 'CDN added successfully.');
    }

    public function editCDN($cdnId)
    {
        $this->editingCDN = CDN::findOrFail($cdnId);
        $this->newCDN = $this->editingCDN->toArray();
    }

    public function updateCDN()
    {
        $this->validate();

        $this->editingCDN->update($this->newCDN);

        $this->reset(['newCDN', 'editingCDN']);
        $this->loadCDNs();
        session()->flash('message', 'CDN updated successfully.');
    }

    public function deleteCDN($cdnId)
    {
        CDN::destroy($cdnId);
        $this->loadCDNs();
        session()->flash('message', 'CDN deleted successfully.');
    }

    public function render()
    {
        return view('livewire.distribution-management.cdn-configuration');
    }
}