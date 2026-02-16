<?php

namespace App\Livewire\DistributionManagement;

use Livewire\Component;
use App\Models\Platform;
use App\Models\Distribution;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;

class ContentDistributionComponent extends Component
{
    public $platforms;
    public $contents;
    public $selectedPlatforms = [];
    public $selectedContent;
    public $scheduledTime;

    protected $rules = [
        'selectedPlatforms' => 'required|array|min:1',
        'selectedContent' => 'required|exists:contents,id',
        'scheduledTime' => 'required|date|after:now',
    ];

    public function mount()
    {
        $this->platforms = Platform::where('status', 'active')->get();
        $this->contents = Content::all(); // Assuming you have a Content model
    }

    public function scheduleDistribution()
    {
        $this->validate();

        foreach ($this->selectedPlatforms as $platformId) {
            Distribution::create([
                'user_id' => Auth::id(),
                'platform_id' => $platformId,
                'content_id' => $this->selectedContent,
                'scheduled_time' => $this->scheduledTime,
                'status' => 'pending',
            ]);
        }

        $this->reset(['selectedPlatforms', 'selectedContent', 'scheduledTime']);
        session()->flash('message', 'Distribution scheduled successfully.');
    }

    public function render()
    {
        $recentDistributions = Distribution::with(['platform', 'content'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('livewire.distribution-management.content-distribution', [
            'recentDistributions' => $recentDistributions,
        ])->layout('layouts.app');
    }
}