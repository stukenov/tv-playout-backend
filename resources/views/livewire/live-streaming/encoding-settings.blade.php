<div>
    <h2 class="text-2xl font-bold mb-4">Encoding Settings</h2>

    <form wire:submit.prevent="saveSettings">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label for="videoCodec" class="block text-sm font-medium text-gray-700">Video Codec</label>
                <select id="videoCodec" wire:model="videoCodec" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="h264">H.264</option>
                    <option value="h265">H.265 (HEVC)</option>
                    <option value="vp9">VP9</option>
                </select>
                @error('videoCodec') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="audioCodec" class="block text-sm font-medium text-gray-700">Audio Codec</label>
                <select id="audioCodec" wire:model="audioCodec" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="aac">AAC</option>
                    <option value="opus">Opus</option>
                </select>
                @error('audioCodec') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="resolution" class="block text-sm font-medium text-gray-700">Resolution</label>
                <select id="resolution" wire:model="resolution" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="720p">720p</option>
                    <option value="1080p">1080p</option>
                    <option value="1440p">1440p</option>
                    <option value="2160p">2160p (4K)</option>
                </select>
                @error('resolution') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="bitrate" class="block text-sm font-medium text-gray-700">Bitrate (kbps)</label>
                <input type="number" id="bitrate" wire:model="bitrate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('bitrate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="framerate" class="block text-sm font-medium text-gray-700">Frame Rate</label>
                <select id="framerate" wire:model="framerate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="24">24 fps</option>
                    <option value="30">30 fps</option>
                    <option value="60">60 fps</option>
                </select>
                @error('framerate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                Save Settings
            </button>
        </div>
    </form>

    <div x-data="{ show: false }" x-show="show" x-init="@this.on('settings-saved', () => { show = true; setTimeout(() => show = false, 3000) })" class="mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Success!</p>
            <p>Your encoding settings have been saved.</p>
        </div>
    </div>
</div>