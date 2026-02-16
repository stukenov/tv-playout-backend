<div>
    <h2 class="text-2xl font-bold mb-4">Schedule Live Stream</h2>

    <form wire:submit.prevent="scheduleStream">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="streamId" class="block text-sm font-medium text-gray-700">Select Stream</label>
                <select id="streamId" wire:model="streamId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select a stream</option>
                    @foreach($streams as $stream)
                        <option value="{{ $stream->id }}">{{ $stream->title }}</option>
                    @endforeach
                </select>
                @error('streamId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="scheduledDate" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" id="scheduledDate" wire:model="scheduledDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('scheduledDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="scheduledTime" class="block text-sm font-medium text-gray-700">Time</label>
                <input type="time" id="scheduledTime" wire:model="scheduledTime" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('scheduledTime') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                <input type="number" id="duration" wire:model="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                Schedule Stream
            </button>
        </div>
    </form>

    <div x-data="{ show: false }" x-show="show" x-init="@this.on('stream-scheduled', () => { show = true; setTimeout(() => show = false, 3000) })" class="mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Success!</p>
            <p>Your live stream has been scheduled.</p>
        </div>
    </div>
</div>