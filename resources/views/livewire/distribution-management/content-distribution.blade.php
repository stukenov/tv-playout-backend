<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">Content Distribution</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="scheduleDistribution">
        <div class="mb-4">
            <label for="content" class="block text-gray-700 font-bold mb-2">Select Content</label>
            <select id="content" wire:model="selectedContent" class="w-full px-3 py-2 border rounded-lg">
                <option value="">Choose content...</option>
                @foreach ($contents as $content)
                    <option value="{{ $content->id }}">{{ $content->title }}</option>
                @endforeach
            </select>
            @error('selectedContent') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Select Platforms</label>
            @foreach ($platforms as $platform)
                <label class="inline-flex items-center mt-3">
                    <input type="checkbox" wire:model="selectedPlatforms" value="{{ $platform->id }}" class="form-checkbox h-5 w-5 text-blue-600">
                    <span class="ml-2 text-gray-700">{{ $platform->name }}</span>
                </label>
            @endforeach
            @error('selectedPlatforms') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="scheduledTime" class="block text-gray-700 font-bold mb-2">Schedule Time</label>
            <input type="datetime-local" id="scheduledTime" wire:model="scheduledTime" class="w-full px-3 py-2 border rounded-lg">
            @error('scheduledTime') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Schedule Distribution
        </button>
    </form>

    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-4">Recent Distributions</h3>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Content</th>
                    <th class="py-2 px-4 border-b">Platform</th>
                    <th class="py-2 px-4 border-b">Scheduled Time</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentDistributions as $distribution)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $distribution->content->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $distribution->platform->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $distribution->scheduled_time }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $distribution->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                   ($distribution->status === 'failed' ? 'bg-red-100 text-red-800' : 
                                   'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($distribution->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>