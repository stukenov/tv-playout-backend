<div>
    <h2 class="text-2xl font-bold mb-4">Adaptive Bitrate Streaming Settings</h2>

    <form wire:submit.prevent="saveSettings">
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="enabled" class="form-checkbox">
                <span class="ml-2">Enable Adaptive Bitrate Streaming</span>
            </label>
        </div>

        @if($enabled)
            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Quality Levels</h3>
                @foreach($qualities as $index => $quality)
                    <div class="flex items-center space-x-4 mb-2">
                        <input type="text" wire:model="qualities.{{ $index }}.resolution" placeholder="Resolution (e.g., 1080p)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <input type="number" wire:model="qualities.{{ $index }}.bitrate" placeholder="Bitrate (kbps)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="qualities.{{ $index }}.enabled" class="form-checkbox">
                            <span class="ml-2">Enabled</span>
                        </label>
                        <button type="button" wire:click="removeQuality({{ $index }})" class="text-red-600 hover:text-red-800">Remove</button>
                    </div>
                @endforeach
                <button type="button" wire:click="addQuality" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add Quality Level
                </button>
            </div>
        @endif

        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                Save Settings
            </button>
        </div>
    </form>

    <div x-data="{ show: false }" x-show="show" x-init="@this.on('settings-saved', () => { show = true; setTimeout(() => show = false, 3000) })" class="mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Success!</p>
            <p>Your ABR settings have been saved.</p>
        </div>
    </div>
</div>