<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use App\Models\Media;
use App\Models\MediaUsage;
use Illuminate\Support\Facades\DB;

class ContentAnalyticsComponent extends Component
{
    public $mediaId;
    public $media;
    public $viewCount;
    public $downloadCount;
    public $usageByDay;

    public function mount($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->loadMedia();
        $this->loadAnalytics();
    }

    public function render()
    {
        return view('livewire.content-analytics-component');
    }

    public function loadMedia()
    {
        $this->media = Media::findOrFail($this->mediaId);
    }

    public function loadAnalytics()
    {
        $this->viewCount = MediaUsage::where('media_id', $this->mediaId)
            ->where('action', 'view')
            ->count();

        $this->downloadCount = MediaUsage::where('media_id', $this->mediaId)
            ->where('action', 'download')
            ->count();

        $this->usageByDay = MediaUsage::where('media_id', $this->mediaId)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
    }
}