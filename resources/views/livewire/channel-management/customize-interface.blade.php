<div class="p-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="saveInterfaceSettings" class="space-y-4">
        <div>
            <label for="uiSettings[theme]" class="block text-sm font-medium text-gray-700">Theme</label>
            <input type="text" id="uiSettings[theme]" wire:model="uiSettings.theme" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('uiSettings.theme') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="uiSettings[layout]" class="block text-sm font-medium text-gray-700">Layout</label>
            <input type="text" id="uiSettings[layout]" wire:model="uiSettings.layout" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('uiSettings.layout') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save Interface Settings</button>
    </form>
</div>