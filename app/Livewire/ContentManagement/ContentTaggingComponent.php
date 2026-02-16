<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use App\Models\Tag;
use App\Models\Media;

class ContentTaggingComponent extends Component
{
    public $mediaId;
    public $selectedTags = [];
    public $newTag = '';
    public $parentTag = null;

    protected $rules = [
        'newTag' => 'required|string|max:50|unique:tags,name',
        'parentTag' => 'nullable|exists:tags,id',
    ];

    public function mount($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->loadSelectedTags();
    }

    public function render()
    {
        $allTags = Tag::orderBy('name')->get();
        $media = Media::findOrFail($this->mediaId);
        return view('livewire.content-tagging-component', [
            'allTags' => $allTags,
            'media' => $media,
        ]);
    }

    public function loadSelectedTags()
    {
        $media = Media::findOrFail($this->mediaId);
        $this->selectedTags = $media->tags->pluck('id')->toArray();
    }

    public function toggleTag($tagId)
    {
        if (in_array($tagId, $this->selectedTags)) {
            $this->selectedTags = array_diff($this->selectedTags, [$tagId]);
        } else {
            $this->selectedTags[] = $tagId;
        }
        $this->saveTags();
    }

    public function saveTags()
    {
        $media = Media::findOrFail($this->mediaId);
        $media->tags()->sync($this->selectedTags);
        $this->emit('tagsUpdated');
    }

    public function createTag()
    {
        $this->validate();

        $tag = Tag::create([
            'name' => $this->newTag,
            'parent_id' => $this->parentTag,
        ]);

        $this->selectedTags[] = $tag->id;
        $this->saveTags();

        $this->reset(['newTag', 'parentTag']);
    }

    public function deleteTag($tagId)
    {
        Tag::destroy($tagId);
        $this->selectedTags = array_diff($this->selectedTags, [$tagId]);
        $this->saveTags();
    }
}