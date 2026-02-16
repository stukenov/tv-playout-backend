<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Media;

class MediaLibraryComponent extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'upload_date';
    public $sortDirection = 'desc';

    public function render()
    {
        $media = Media::search($this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.content-management.media-library-component', [
            'media' => $media,
        ])->layout('layouts.app');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }
}