<?php

namespace App\Livewire\DistributionManagement;

use Livewire\Component;
use App\Models\Distribution;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;

class DistributionDashboardComponent extends Component
{
    public $distributions;
    public $platforms;
    public $selectedPlatform = null;
    public $dateRange = 'week';

    public function mount()
    {
        $this->platforms = Platform::all();
        $this->loadDistributions();
    }

    public function loadDistributions()
    {
        $query = Distribution::with(['platform', 'content'])
            ->where('user_id', Auth::id());

        if ($this->selectedPlatform) {
            $query->where('platform_id', $this->selectedPlatform);
        }

        switch ($this->dateRange) {
            case 'day':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month);
                break;
        }

        $this->distributions = $query->get();
    }

    public function updatedSelectedPlatform()
    {
        $this->loadDistributions();
    }

    public function updatedDateRange()
    {
        $this->loadDistributions();
    }

    public function getStatusCountsProperty()
    {
        return $this->distributions->groupBy('status')->map->count();
    }

    public function render()
    {
        return view('livewire.distribution-management.distribution-dashboard', [
            'statusCounts' => $this->statusCounts,
        ])->layout('layouts.app');
    }
}