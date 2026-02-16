<div class="p-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="saveSettings" class="space-y-4">
        <div class="flex flex-col">
            <label for="resolution" class="mb-2 font-semibold text-gray-700">Resolution</label>
            <input type="text" id="resolution" wire:model="resolution" class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('resolution') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col">
            <label for="bitrate" class="mb-2 font-semibold text-gray-700">Bitrate</label>
            <input type="number" id="bitrate" wire:model="bitrate" class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('bitrate') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col">
            <label for="encodingFormat" class="mb-2 font-semibold text-gray-700">Encoding Format</label>
            <input type="text" id="encodingFormat" wire:model="encodingFormat" class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('encodingFormat') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Save Settings</button>
    </form>
</div>