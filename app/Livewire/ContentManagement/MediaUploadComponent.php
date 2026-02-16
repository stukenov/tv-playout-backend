<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Media;

class MediaUploadComponent extends Component
{
    use WithFileUploads;

    public $file;
    public $title;
    public $description;

    protected $rules = [
        'file' => 'required|file|max:1024000', // 1GB Max
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function upload()
    {
        $this->validate();

        $path = $this->file->store('media', 'public');

        Media::create([
            'title' => $this->title,
            'description' => $this->description,
            'file_path' => $path,
            'file_name' => $this->file->getClientOriginalName(),
            'file_size' => $this->file->getSize(),
            'mime_type' => $this->file->getMimeType(),
        ]);

        $this->reset(['file', 'title', 'description']);
        session()->flash('message', 'Media uploaded successfully.');
    }

    public function render()
    {
        return view('livewire.content-management.media-upload-component')->layout('layouts.app');
    }
}