<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">Alerting System</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveAlertPreference" class="mb-6">
        <div class="mb-4">
            <label for="alertType" class="block text-sm font-medium text-gray-700">Alert Type</label>
            <select id="alertType" wire:model="newAlert.type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Select alert type</option>
                <option value="distribution_failure">Distribution Failure</option>
                <option value="performance_drop">Performance Drop</option>
                <option value="successful_deployment">Successful Deployment</option>
            </select>
            @error('newAlert.type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="threshold" class="block text-sm font-medium text-gray-700">Threshold</label>
            <input type="number" id="threshold" wire:model="newAlert.threshold" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newAlert.threshold') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="notificationMethod" class="block text-sm font-medium text-gray-700">Notification Method</label>
            <select id="notificationMethod" wire:model="newAlert.notification_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="email">Email</option>
                <option value="sms">SMS</option>
                <option value="in-app">In-App Notification</option>
            </select>
            @error('newAlert.notification_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Alert Preference
        </button>
    </form>

    <h3 class="text-xl font-semibold mb-2">Current Alert Preferences</h3>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Threshold</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notification Method</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($alertPreferences as $alert)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst(str_replace('_', ' ', $alert->type)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $alert->threshold }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($alert->notification_method) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="deleteAlertPreference({{ $alert->id }})" class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>