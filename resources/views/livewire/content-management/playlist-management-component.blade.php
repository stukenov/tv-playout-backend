<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Playlist Management</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Create New Playlist</h3>
        <form wire:submit.prevent="createPlaylist" class="space-y-2">
            <input wire:model="newPlaylistName" type="text" class="form-input w-full" placeholder="Playlist name">
            @error('newPlaylistName') <span class="text-red-500">{{ $message }}</span> @enderror
            <textarea wire:model="newPlaylistDescription" class="form-textarea w-full" placeholder="Playlist description"></textarea>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Playlist
            </button>
        </form>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Your Playlists</h3>
        <ul class="space-y-2">
            @foreach ($playlists as $playlist)
                <li class="flex items-center justify-between">
                    <span class="cursor-pointer" wire:click="selectPlaylist('{{ $playlist->id }}')">
                        {{ $playlist->name }}
                    </span>
                    <button wire:click="deletePlaylist('{{ $playlist->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                        Delete
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    @if ($currentPlaylist)
        <div class="mb-4">
            <h3 class="text-lg font-semibold mb-2">{{ $currentPlaylist->name }} - Media</h3>
            <ul wire:sortable="updateMediaOrder" class="space-y-2">
                @foreach ($currentPlaylist->media as $media)
                    <li wire:sortable.item="{{ $media->id }}" wire:key="media-{{ $media->id }}" class="flex items-center justify-between bg-gray-100 p-2">
                        <span wire:sortable.handle class="cursor-move">{{ $media->file_name }}</span>
                        <button wire:click="removeMediaFromPlaylist('{{ $media->id }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                            Remove
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold mb-2">Available Media</h3>
            <ul class="space-y-2">
                @foreach ($availableMedia as $media)
                    @if (!$currentPlaylist->media->contains($media->id))
                        <li class="flex items-center justify-between bg-gray-100 p-2">
                            <span>{{ $media->file_name }}</span>
                            <button wire:click="addMediaToPlaylist('{{ $media->id }}')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-sm">
                                Add to Playlist
                            </button>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
</div>