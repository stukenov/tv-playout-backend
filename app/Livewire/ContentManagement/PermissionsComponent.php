<?php

namespace App\Livewire\ContentManagement;

use Livewire\Component;
use App\Models\Media;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionsComponent extends Component
{
    public $mediaId;
    public $users = [];
    public $selectedUser;
    public $permissionLevel = 'view';

    protected $rules = [
        'selectedUser' => 'required|exists:users,id',
        'permissionLevel' => 'required|in:view,edit,delete',
    ];

    public function mount($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->loadUsers();
    }

    public function render()
    {
        $media = Media::findOrFail($this->mediaId);
        $permissions = Permission::where('media_id', $this->mediaId)->with('user')->get();
        return view('livewire.permissions-component', [
            'media' => $media,
            'permissions' => $permissions,
        ]);
    }

    public function loadUsers()
    {
        $this->users = User::where('id', '!=', Auth::id())->get();
    }

    public function addPermission()
    {
        $this->validate();

        Permission::updateOrCreate(
            [
                'user_id' => $this->selectedUser,
                'media_id' => $this->mediaId,
            ],
            [
                'permission_level' => $this->permissionLevel,
            ]
        );

        $this->reset(['selectedUser', 'permissionLevel']);
        $this->emit('permissionAdded');
    }

    public function removePermission($permissionId)
    {
        Permission::destroy($permissionId);
        $this->emit('permissionRemoved');
    }

    public function updatePermission($permissionId, $newLevel)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->update(['permission_level' => $newLevel]);
        $this->emit('permissionUpdated');
    }
}