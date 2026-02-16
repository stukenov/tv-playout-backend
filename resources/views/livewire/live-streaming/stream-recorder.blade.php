<div>
    <h2 class="text-2xl font-bold mb-4">Stream Recorder</h2>

    @if($activeStreams->isEmpty())
        <p class="text-gray-500">No active streams available for recording.</p>
    @else
        <div class="mb-4">
            <label for="streamSelect" class="block text-sm font-medium text-gray-700">Select Stream to Record</label>
            <select id="streamSelect" wire:model="selectedStreamId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select a stream</option>
                @foreach($activeStreams as $stream)
                    <option value="{{ $stream->id }}">{{ $stream->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            @if($isRecording)
                <button wire:click="stopRecording" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                    Stop Recording
                </button>
            @else
                <button wire:click="startRecording" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition" @if(!$selectedStreamId) disabled @endif>
                    Start Recording
                </button>
            @endif
        </div>
    @endif

    <h3 class="text-xl font-semibold mb-2">Recordings</h3>
    @if($recordings->isEmpty())
        <p class="text-gray-500">No recordings available.</p>
    @else
        <div class="space-y-4">
            @foreach($recordings as $recording)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div>
                            <h4 class="text-lg leading-6 font-medium text-gray-900">{{ $recording->liveStream->title }}</h4>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Recorded on: {{ $recording->created_at->format('M d, Y H:i') }}
                            </p>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Status: {{ ucfirst($recording->status) }}
                            </p>
                        </div>
                        <div>
                            @if(!$recording->added_to_vod)
                                <button wire:click="addToVOD({{ $recording->id }})" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Add to VOD
                                </button>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Added to VOD
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div x-data="{ show: false, message: '' }" x-show="show" x-init="
        @this.on('recording-started', () => { show = true; message = 'Recording started successfully.'; setTimeout(() => show = false, 3000) })
        @this.on('recording-stopped', () => { show = true; message = 'Recording stopped successfully.'; setTimeout(() => show = false, 3000) })
        @this.on('added-to-vod', () => { show = true; message = 'Recording added to VOD library.'; setTimeout(() => show = false, 3000) })
    " class="mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Success!</p>
            <p x-text="message"></p>
        </div>
    </div>
</div>