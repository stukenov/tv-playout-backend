<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Folder Management</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">
            @if ($currentFolder)
                {{ $currentFolder->name }}
            @else
                Root Folder
            @endif
        </h3>
        @if ($parentFolderId)
            <button wire:click="navigateUp" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Up to Parent Folder
            </button>
        @endif
    </div>

    <div class="mb-4">
        <h4 class="text-lg font-semibold mb-2">Create New Folder</h4>
        <form wire:submit.prevent="createFolder" class="flex items-center">
            <input wire:model="newFolderName" type="text" class="form-input mr-2" placeholder="New folder name">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Folder
            </button>
        </form>
        @error('newFolderName') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <h4 class="text-lg font-semibold mb-2">Folders</h4>
        <ul class="list-disc list-inside">
            @foreach ($folders as $folder)
                <li class="flex items-center justify-between py-2">
                    <span class="cursor-pointer" wire:click="navigateToFolder('{{ $folder->id }}')">
                        {{ $folder->name }}
                    </span>
                    <button wire:click="deleteFolder('{{ $folder->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                        Delete
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</div>