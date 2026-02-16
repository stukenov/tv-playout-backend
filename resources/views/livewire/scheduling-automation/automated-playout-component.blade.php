<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-4">Automated Playout</h1>
    <ul class="space-y-4">
        @foreach($schedules as $schedule)
            <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <div>
                    <span class="font-medium">{{ $schedule->name }}</span> - 
                    <span class="text-gray-500">Status: {{ $status[$schedule->id] }}</span>
                </div>
                <div class="space-x-2">
                    <button wire:click="start({{ $schedule->id }})" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Start</button>
                    <button wire:click="stop({{ $schedule->id }})" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Stop</button>
                </div>
            </li>
        @endforeach
    </ul>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
</div>