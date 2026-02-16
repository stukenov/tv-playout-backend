<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">API Integration</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $editingIntegration ? 'updateIntegration' : 'saveIntegration' }}" class="mb-6">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Integration Name</label>
            <input type="text" id="name" wire:model="newIntegration.name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newIntegration.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="api_key" class="block text-sm font-medium text-gray-700">API Key</label>
            <input type="text" id="api_key" wire:model="newIntegration.api_key" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newIntegration.api_key') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="webhook_url" class="block text-sm font-medium text-gray-700">Webhook URL</label>
            <input type="url" id="webhook_url" wire:model="newIntegration.webhook_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newIntegration.webhook_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="status" wire:model="newIntegration.status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            @error('newIntegration.status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $editingIntegration ? 'Update Integration' : 'Add Integration' }}
        </button>
    </form>

    <h3 class="text-xl font-semibold mb-2">Current API Integrations</h3>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">API Key</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Webhook URL</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($integrations as $integration)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $integration->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($integration->api_key, 20) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($integration->webhook_url, 30) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $integration->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($integration->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="editIntegration({{ $integration->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</button>
                        <button wire:click="deleteIntegration({{ $integration->id }})" class="text-red-600 hover:text-red-900 mr-2">Delete</button>
                        <button wire:click="testWebhook({{ $integration->id }})" class="text-green-600 hover:text-green-900">Test Webhook</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>