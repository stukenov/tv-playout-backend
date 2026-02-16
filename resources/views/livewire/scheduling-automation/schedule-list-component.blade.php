<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Schedule List</h1>
    <table class="min-w-full bg-white rounded-lg shadow-md">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Channel</th>
                <th class="py-3 px-6 text-left">Start Time</th>
                <th class="py-3 px-6 text-left">End Time</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($schedules as $schedule)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $schedule->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $schedule->channel }}</td>
                    <td class="py-3 px-6 text-left">{{ $schedule->start_time }}</td>
                    <td class="py-3 px-6 text-left">{{ $schedule->end_time }}</td>
                    <td class="py-3 px-6 text-center">
                        <button wire:click="edit({{ $schedule->id }})" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">Edit</button>
                        <button wire:click="delete({{ $schedule->id }})" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>