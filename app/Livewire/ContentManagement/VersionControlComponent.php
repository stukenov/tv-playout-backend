<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use App\Models\Media;
use App\Models\Version;
use Illuminate\Support\Facades\Storage;

class VersionControlComponent extends Component
{
    public $mediaId;
    public $versions = [];
    public $currentVersion;

    public function mount($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->loadVersions();
    }

    public function render()
    {
        return view('livewire.version-control-component');
    }

    public function loadVersions()
    {
        $media = Media::findOrFail($this->mediaId);
        $this->versions = $media->versions()->orderBy('version_number', 'desc')->get();
        $this->currentVersion = $media->version;
    }

    public function revertToVersion($versionId)
    {
        $version = Version::findOrFail($versionId);
        $media = Media::findOrFail($this->mediaId);

        // Create a new version with the current file
        $newVersion = new Version([
            'version_number' => $media->version + 1,
            'file_url' => $media->storage_url,
        ]);
        $media->versions()->save($newVersion);

        // Update the media with the reverted version
        $media->update([
            'storage_url' => $version->file_url,
            'version' => $version->version_number,
        ]);

        $this->loadVersions();
        $this->emit('versionReverted');
    }

    public function deleteVersion($versionId)
    {
        $version = Version::findOrFail($versionId);
        $media = Media::findOrFail($this->mediaId);

        if ($version->version_number !== $media->version) {
            // Delete the file associated with this version
            Storage::delete($version->file_url);
            $version->delete();
            $this->loadVersions();
            $this->emit('versionDeleted');
        } else {
            $this->addError('deleteVersion', 'Cannot delete the current version.');
        }
    }
}