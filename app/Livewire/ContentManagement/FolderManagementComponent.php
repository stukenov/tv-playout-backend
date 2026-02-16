<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderManagementComponent extends Component
{
    public $folders;
    public $currentFolder;
    public $newFolderName = '';
    public $parentFolderId;

    protected $rules = [
        'newFolderName' => 'required|string|max:255',
    ];

    public function mount($folderId = null)
    {
        $this->loadFolders($folderId);
    }

    public function render()
    {
        return view('livewire.content-management.folder-management-component')->layout('layouts.app');
    }

    public function loadFolders($folderId = null)
    {
        if ($folderId) {
            $this->currentFolder = Folder::findOrFail($folderId);
            $this->folders = $this->currentFolder->children;
            $this->parentFolderId = $this->currentFolder->parent_id;
        } else {
            $this->folders = Folder::whereNull('parent_id')->where('user_id', Auth::id())->get();
            $this->currentFolder = null;
            $this->parentFolderId = null;
        }
    }

    public function createFolder()
    {
        $this->validate();

        Folder::create([
            'name' => $this->newFolderName,
            'parent_id' => $this->currentFolder ? $this->currentFolder->id : null,
            'user_id' => Auth::id(),
        ]);

        $this->newFolderName = '';
        $this->loadFolders($this->currentFolder ? $this->currentFolder->id : null);
    }

    public function deleteFolder($folderId)
    {
        $folder = Folder::findOrFail($folderId);
        $folder->delete();
        $this->loadFolders($this->currentFolder ? $this->currentFolder->id : null);
    }

    public function navigateToFolder($folderId)
    {
        $this->loadFolders($folderId);
    }

    public function navigateUp()
    {
        $this->loadFolders($this->parentFolderId);
    }
}