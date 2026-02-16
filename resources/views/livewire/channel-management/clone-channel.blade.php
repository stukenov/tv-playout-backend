<div class="p-4 bg-white rounded shadow-md">
    <form wire:submit.prevent="cloneChannel" class="space-y-4">
        <div>
            <label for="newChannelName" class="block text-sm font-medium text-gray-700">New Channel Name</label>
            <input type="text" id="newChannelName" wire:model="newChannelName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newChannelName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Clone Channel</button>
    </form>
</div>