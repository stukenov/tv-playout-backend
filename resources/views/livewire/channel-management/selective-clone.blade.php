<div class="p-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="cloneChannel" class="space-y-4">
        <div>
            <label for="newChannelName" class="block text-sm font-medium text-gray-700">New Channel Name</label>
            <input type="text" id="newChannelName" wire:model="newChannelName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newChannelName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="cloneBranding" wire:model="cloneBranding" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
            <label for="cloneBranding" class="ml-2 block text-sm text-gray-900">Clone Branding</label>
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="cloneSchedule" wire:model="cloneSchedule" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
            <label for="cloneSchedule" class="ml-2 block text-sm text-gray-900">Clone Schedule</label>
        </div>

        <div class="flex items-center">
            <input type="checkbox" id="cloneContent" wire:model="cloneContent" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
            <label for="cloneContent" class="ml-2 block text-sm text-gray-900">Clone Content</label>
        </div>

        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Clone Channel</button>
    </form>
</div>