<?php

namespace App\Livewire\DistributionManagement;

use Livewire\Component;
use App\Models\APIIntegration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class APIIntegrationComponent extends Component
{
    public $integrations;
    public $newIntegration = [
        'name' => '',
        'api_key' => '',
        'webhook_url' => '',
        'status' => 'active',
    ];
    public $editingIntegration = null;

    protected $rules = [
        'newIntegration.name' => 'required|string|max:255',
        'newIntegration.api_key' => 'required|string|max:255',
        'newIntegration.webhook_url' => 'required|url',
        'newIntegration.status' => 'required|in:active,inactive',
    ];

    public function mount()
    {
        $this->loadIntegrations();
    }

    public function loadIntegrations()
    {
        $this->integrations = APIIntegration::where('user_id', Auth::id())->get();
    }

    public function saveIntegration()
    {
        $this->validate();

        APIIntegration::create(array_merge($this->newIntegration, ['user_id' => Auth::id()]));

        $this->reset('newIntegration');
        $this->loadIntegrations();
        session()->flash('message', 'API integration added successfully.');
    }

    public function editIntegration($integrationId)
    {
        $this->editingIntegration = APIIntegration::findOrFail($integrationId);
        $this->newIntegration = $this->editingIntegration->toArray();
    }

    public function updateIntegration()
    {
        $this->validate();

        $this->editingIntegration->update($this->newIntegration);

        $this->reset(['newIntegration', 'editingIntegration']);
        $this->loadIntegrations();
        session()->flash('message', 'API integration updated successfully.');
    }

    public function deleteIntegration($integrationId)
    {
        APIIntegration::destroy($integrationId);
        $this->loadIntegrations();
        session()->flash('message', 'API integration deleted successfully.');
    }

    public function testWebhook($integrationId)
    {
        $integration = APIIntegration::findOrFail($integrationId);
        
        try {
            $response = Http::post($integration->webhook_url, [
                'event' => 'test',
                'message' => 'This is a test webhook from CloudPlayout.',
            ]);

            if ($response->successful()) {
                session()->flash('message', 'Webhook test successful.');
            } else {
                session()->flash('error', 'Webhook test failed. Status: ' . $response->status());
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Webhook test failed. Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.distribution-management.api-integration');
    }
}