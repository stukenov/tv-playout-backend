<?php

namespace App\Livewire\DistributionManagement;

use Livewire\Component;
use App\Models\Distribution;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonitoringAnalyticsComponent extends Component
{
    public $selectedPlatform = null;
    public $dateRange = 'week';
    public $platforms;

    public function mount()
    {
        $this->platforms = Platform::all();
    }

    public function getDistributionStatsProperty()
    {
        $query = Distribution::where('user_id', Auth::id());

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

        return $query->select('status', DB::raw('count(*) as count'))
                     ->groupBy('status')
                     ->pluck('count', 'status')
                     ->toArray();
    }

    public function getSuccessRateProperty()
    {
        $total = array_sum($this->distributionStats);
        $completed = $this->distributionStats['completed'] ?? 0;
        return $total > 0 ? round(($completed / $total) * 100, 2) : 0;
    }

    public function getAverageDistributionTimeProperty()
    {
        $query = Distribution::where('user_id', Auth::id())
                             ->whereNotNull('actual_time')
                             ->where('status', 'completed');

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

        $avgTime = $query->avg(DB::raw('TIMESTAMPDIFF(MINUTE, scheduled_time, actual_time)'));
        return $avgTime ? round($avgTime, 2) : 0;
    }

    public function render()
    {
        return view('livewire.distribution-management.monitoring-analytics', [
            'distributionStats' => $this->distributionStats,
            'successRate' => $this->successRate,
            'averageDistributionTime' => $this->averageDistributionTime,
        ]);
    }
}