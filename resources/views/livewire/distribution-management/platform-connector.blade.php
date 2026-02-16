<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">Platform Connector</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editingPlatform ? 'updatePlatform' : 'savePlatform' }}">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Platform Name</label>
            <input type="text" id="name" wire:model="newPlatform.name" class="w-full px-3 py-2 border rounded-lg">
            @error('newPlatform.name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="type" class="block text-gray-700 font-bold mb-2">Platform Type</label>
            <input type="text" id="type" wire:model="newPlatform.type" class="w-full px-3 py-2 border rounded-lg">
            @error('newPlatform.type') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="api_endpoint" class="block text-gray-700 font-bold mb-2">API Endpoint</label>
            <input type="text" id="api_endpoint" wire:model="newPlatform.api_endpoint" class="w-full px-3 py-2 border rounded-lg">
            @error('newPlatform.api_endpoint') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="credentials" class="block text-gray-700 font-bold mb-2">API Credentials</label>
            <textarea id="credentials" wire:model="newPlatform.credentials" class="w-full px-3 py-2 border rounded-lg" rows="3"></textarea>
            @error('newPlatform.credentials') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $editingPlatform ? 'Update Platform' : 'Add Platform' }}
        </button>
    </form>

    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-4">Connected Platforms</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($platforms as $platform)
                <div class="border rounded-lg p-4">
                    <h4 class="font-bold">{{ $platform->name }}</h4>
                    <p class="text-gray-600">Type: {{ $platform->type }}</p>
                    <p class="text-gray-600">Endpoint: {{ $platform->api_endpoint }}</p>
                    <div class="mt-4">
                        <button wire:click="editPlatform({{ $platform->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">
                            Edit
                        </button>
                        <button wire:click="deletePlatform({{ $platform->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                            Delete
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>