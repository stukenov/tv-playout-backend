<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-4">Ad Insertion Management</h1>
    <form wire:submit.prevent="addRule" class="space-y-4">
        <div>
            <label for="criteria" class="block text-sm font-medium text-gray-700">Criteria</label>
            <input type="text" id="criteria" wire:model="newRule.criteria" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newRule.criteria') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="frequency" class="block text-sm font-medium text-gray-700">Frequency</label>
            <input type="number" id="frequency" wire:model="newRule.frequency" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('newRule.frequency') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add Rule</button>
    </form>

    <h2 class="text-xl font-semibold mt-6">Existing Ad Rules</h2>
    <ul class="mt-4 space-y-2">
        @foreach($adRules as $rule)
            <li class="bg-white p-4 rounded-lg shadow-md">{{ $rule->criteria }} - Frequency: {{ $rule->frequency }}</li>
        @endforeach
    </ul>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
</div>