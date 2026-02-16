<div class="p-4 bg-white rounded shadow-md">
    <form wire:submit.prevent="assignSchedule" class="space-y-4">
        <div>
            <label for="selectedSchedule" class="block text-sm font-medium text-gray-700">Select Schedule</label>
            <select id="selectedSchedule" wire:model="selectedSchedule" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Choose schedule</option>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                @endforeach
            </select>
            @error('selectedSchedule') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Assign Schedule</button>
    </form>

    <h3 class="mt-6 text-lg font-medium text-gray-900">Assigned Schedules</h3>
    <ul class="mt-2 space-y-2">
        @foreach($channelSchedules as $schedule)
            <li class="text-gray-700">{{ $schedule->name }}</li>
        @endforeach
    </ul>
</div>