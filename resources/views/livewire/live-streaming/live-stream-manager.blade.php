<div>
    <h2 class="text-2xl font-bold mb-4">Live Stream Manager</h2>

    <div class="mb-4">
        <a href="{{ route('live-streaming.monitoring') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
            Live Monitoring Dashboard
        </a>
    </div>

    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-2">Start a New Stream</h3>
        <form wire:submit.prevent="startStream">
            <div class="mb-4">
                <label for="newStreamTitle" class="block text-sm font-medium text-gray-700">Stream Title</label>
                <input type="text" id="newStreamTitle" wire:model="newStreamTitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('newStreamTitle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="newStreamDescription" class="block text-sm font-medium text-gray-700">Description (optional)</label>
                <textarea id="newStreamDescription" wire:model="newStreamDescription" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('newStreamDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                Start Stream
            </button>
        </form>
    </div>

    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-2">Your Streams</h3>
        @forelse ($streams as $stream)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $stream->title }}</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $stream->description }}</p>
                    </div>
                    <div>
                        @if($stream->status === 'live')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Live
                            </span>
                            <button wire:click="stopStream({{ $stream->id }})" class="ml-2 inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                                Stop Stream
                            </button>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Ended
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You haven't started any streams yet.</p>
        @endforelse
    </div>

    <div>
        <h3 class="text-lg font-semibold mb-2">Scheduled Streams</h3>
        @forelse ($scheduledStreams as $schedule)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <div>
                        <h4 class="text-lg leading-6 font-medium text-gray-900">{{ $schedule->liveStream->title }}</h4>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Scheduled for: {{ $schedule->scheduled_start->format('M d, Y H:i') }}
                        </p>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Duration: {{ $schedule->duration }} minutes
                        </p>
                    </div>
                    <div>
                        @if($schedule->scheduled_start->isPast() && $schedule->liveStream->status !== 'live')
                            <button wire:click="startScheduledStream({{ $schedule->id }})" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150">
                                Start Stream
                            </button>
                        @elseif($schedule->liveStream->status === 'live')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Live
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Scheduled
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You don't have any scheduled streams.</p>
        @endforelse
    </div>
</div>