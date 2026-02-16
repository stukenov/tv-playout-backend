<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">Distribution Dashboard</h2>

    <div class="mb-4 flex justify-between items-center">
        <div>
            <label for="platform" class="block text-sm font-medium text-gray-700">Platform</label>
            <select id="platform" wire:model="selectedPlatform" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">All Platforms</option>
                @foreach($platforms as $platform)
                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="dateRange" class="block text-sm font-medium text-gray-700">Date Range</label>
            <select id="dateRange" wire:model="dateRange" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="day">Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-4 mb-6">
        @foreach(['pending', 'in-progress', 'completed', 'failed'] as $status)
            <div class="bg-gray-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold mb-2">{{ ucfirst($status) }}</h3>
                <p class="text-3xl font-bold">{{ $statusCounts[$status] ?? 0 }}</p>
            </div>
        @endforeach
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Platform</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scheduled Time</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($distributions as $distribution)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $distribution->content->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $distribution->platform->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $distribution->status === 'completed' ? 'bg-green-100 text-green-800' : 
                               ($distribution->status === 'failed' ? 'bg-red-100 text-red-800' : 
                               'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($distribution->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $distribution->scheduled_time->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>