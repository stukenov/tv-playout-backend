<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use App\Models\Media;
use App\Models\Metadata;

class MetadataComponent extends Component
{
    public $mediaId;
    public $title;
    public $description;
    public $genre;
    public $language;
    public $tags = [];
    public $customFields = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'genre' => 'nullable|string|max:100',
        'language' => 'nullable|string|max:50',
        'tags' => 'nullable|array',
        'tags.*' => 'string|max:50',
        'customFields.*.key' => 'required|string|max:50',
        'customFields.*.value' => 'required|string|max:255',
    ];

    public function mount($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->loadMetadata();
    }

    public function render()
    {
        return view('livewire.metadata-component');
    }

    public function loadMetadata()
    {
        $metadata = Metadata::where('media_id', $this->mediaId)->first();
        if ($metadata) {
            $this->title = $metadata->title;
            $this->description = $metadata->description;
            $this->genre = $metadata->genre;
            $this->language = $metadata->language;
            $this->tags = $metadata->tags ?? [];
            $this->customFields = $metadata->custom_fields ?? [];
        }
    }

    public function saveMetadata()
    {
        $this->validate();

        Metadata::updateOrCreate(
            ['media_id' => $this->mediaId],
            [
                'title' => $this->title,
                'description' => $this->description,
                'genre' => $this->genre,
                'language' => $this->language,
                'tags' => $this->tags,
                'custom_fields' => $this->customFields,
            ]
        );

        $this->emit('metadataSaved');
    }

    public function addCustomField()
    {
        $this->customFields[] = ['key' => '', 'value' => ''];
    }

    public function removeCustomField($index)
    {
        unset($this->customFields[$index]);
        $this->customFields = array_values($this->customFields);
    }

    public function addTag()
    {
        $this->tags[] = '';
    }

    public function removeTag($index)
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
    }
}