<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use App\Models\Media;

class ContentPreviewComponent extends Component
{
    public $mediaId;
    public $media;

    public function mount($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->loadMedia();
    }

    public function render()
    {
        return view('livewire.content-preview-component');
    }

    public function loadMedia()
    {
        $this->media = Media::findOrFail($this->mediaId);
    }

    public function getMediaTypeProperty()
    {
        $mimeType = $this->media->file_type;
        if (strpos($mimeType, 'video/') === 0) {
            return 'video';
        } elseif (strpos($mimeType, 'audio/') === 0) {
            return 'audio';
        } elseif (strpos($mimeType, 'image/') === 0) {
            return 'image';
        } else {
            return 'unknown';
        }
    }
}