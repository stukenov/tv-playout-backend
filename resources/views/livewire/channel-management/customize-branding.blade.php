<div class="p-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="saveBranding" class="space-y-6">
        <div class="flex flex-col">
            <label for="logo" class="mb-2 text-sm font-medium text-gray-700">Channel Logo</label>
            <input type="file" id="logo" wire:model="logo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
            @error('logo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col">
            <label for="banner" class="mb-2 text-sm font-medium text-gray-700">Channel Banner</label>
            <input type="file" id="banner" wire:model="banner" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
            @error('banner') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col">
            <label for="colorScheme" class="mb-2 text-sm font-medium text-gray-700">Color Scheme</label>
            <input type="text" id="colorScheme" wire:model="colorScheme" class="block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-200">
            @error('colorScheme') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200">Save Branding</button>
    </form>
</div>