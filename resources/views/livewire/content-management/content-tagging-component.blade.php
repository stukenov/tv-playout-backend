<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Content Tagging</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Current Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach ($allTags as $tag)
                <button
                    wire:click="toggleTag({{ $tag->id }})"
                    class="px-3 py-1 rounded-full text-sm font-semibold {{ in_array($tag->id, $selectedTags) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }}"
                >
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Create New Tag</h3>
        <form wire:submit.prevent="createTag" class="flex items-center gap-2">
            <input
                type="text"
                wire:model="newTag"
                placeholder="New tag name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
            <select
                wire:model="parentTag"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
                <option value="">No parent</option>
                @foreach ($allTags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Create Tag
            </button>
        </form>
        @error('newTag') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Manage Tags</h3>
        <ul class="list-disc list-inside">
            @foreach ($allTags as $tag)
                <li class="flex items-center justify-between py-1">
                    <span>{{ $tag->name }} {{ $tag->parent ? '(Child of ' . $tag->parent->name . ')' : '' }}</span>
                    <button
                        wire:click="deleteTag({{ $tag->id }})"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm"
                    >
                        Delete
                    </button>
                </li>
            @endforeach
        </ul>
    </div>
</div>