<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Edit Metadata</h2>

    <form wire:submit.prevent="saveMetadata">
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
            <input type="text" id="genre" wire:model="genre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('genre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
            <input type="text" id="language" wire:model="language" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            @foreach ($tags as $index => $tag)
                <div class="flex items-center mt-2">
                    <input type="text" wire:model="tags.{{ $index }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <button type="button" wire:click="removeTag({{ $index }})" class="ml-2 text-red-500">Remove</button>
                </div>
            @endforeach
            <button type="button" wire:click="addTag" class="mt-2 text-blue-500">Add Tag</button>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Custom Fields</label>
            @foreach ($customFields as $index => $field)
                <div class="flex items-center mt-2">
                    <input type="text" wire:model="customFields.{{ $index }}.key" placeholder="Key" class="mt-1 block w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <input type="text" wire:model="customFields.{{ $index }}.value" placeholder="Value" class="mt-1 ml-2 block w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <button type="button" wire:click="removeCustomField({{ $index }})" class="ml-2 text-red-500">Remove</button>
                </div>
            @endforeach
            <button type="button" wire:click="addCustomField" class="mt-2 text-blue-500">Add Custom Field</button>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Save Metadata
        </button>
    </form>
</div>