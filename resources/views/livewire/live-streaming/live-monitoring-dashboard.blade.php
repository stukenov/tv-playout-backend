<div>
    <h2 class="text-2xl font-bold mb-4">Live Monitoring Dashboard</h2>

    @if($activeStreams->isEmpty())
        <p class="text-gray-500">No active streams at the moment.</p>
    @else
        <div class="mb-4">
            <label for="streamSelect" class="block text-sm font-medium text-gray-700">Select Stream</label>
            <select id="streamSelect" wire:model="selectedStreamId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach($activeStreams as $stream)
                    <option value="{{ $stream->id }}">{{ $stream->title }}</option>
                @endforeach
            </select>
        </div>

        @if($selectedStreamId)
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">Bitrate</h3>
                    <p class="text-3xl font-bold">{{ $streamMetrics['bitrate'] }} kbps</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">Frame Rate</h3>
                    <p class="text-3xl font-bold">{{ $streamMetrics['framerate'] }} fps</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">Latency</h3>
                    <p class="text-3xl font-bold">{{ $streamMetrics['latency'] }} s</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">Errors</h3>
                    <p class="text-3xl font-bold">{{ $streamMetrics['errors'] }}</p>
                </div>
            </div>
        @endif
    @endif
</div>