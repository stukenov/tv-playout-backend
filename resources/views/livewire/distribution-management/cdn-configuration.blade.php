<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">CDN Configuration</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editingCDN ? 'updateCDN' : 'saveCDN' }}">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">CDN Name</label>
            <input type="text" id="name" wire:model="newCDN.name" class="w-full px-3 py-2 border rounded-lg">
            @error('newCDN.name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="provider" class="block text-gray-700 font-bold mb-2">CDN Provider</label>
            <input type="text" id="provider" wire:model="newCDN.provider" class="w-full px-3 py-2 border rounded-lg">
            @error('newCDN.provider') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="configuration" class="block text-gray-700 font-bold mb-2">Configuration (JSON)</label>
            <textarea id="configuration" wire:model="newCDN.configuration" class="w-full px-3 py-2 border rounded-lg" rows="4"></textarea>
            @error('newCDN.configuration') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $editingCDN ? 'Update CDN' : 'Add CDN' }}
        </button>
    </form>

    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-4">Configured CDNs</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($cdns as $cdn)
                <div class="border rounded-lg p-4">
                    <h4 class="font-bold">{{ $cdn->name }}</h4>
                    <p class="text-gray-600">Provider: {{ $cdn->provider }}</p>
                    <div class="mt-4">
                        <button wire:click="editCDN({{ $cdn->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">
                            Edit
                        </button>
                        <button wire:click="deleteCDN({{ $cdn->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                            Delete
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>