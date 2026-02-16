<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">Distribution Analytics</h2>

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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Success Rate</h3>
            <p class="text-3xl font-bold">{{ $successRate }}%</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Completed Distributions</h3>
            <p class="text-3xl font-bold">{{ $distributionStats['completed'] ?? 0 }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Avg. Distribution Time</h3>
            <p class="text-3xl font-bold">{{ $averageDistributionTime }} min</p>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Distribution Status Breakdown</h3>
        <div class="flex justify-between items-end h-64">
            @foreach(['pending', 'in-progress', 'completed', 'failed'] as $status)
                <div class="w-1/5 flex flex-col items-center">
                    <div class="w-full bg-gray-200 rounded-t">
                        <div class="bg-blue-500 rounded-t" style="height: {{ ($distributionStats[$status] ?? 0) / max($distributionStats) * 100 }}%"></div>
                    </div>
                    <span class="mt-2 text-sm font-medium">{{ ucfirst($status) }}</span>
                    <span class="text-sm text-gray-500">{{ $distributionStats[$status] ?? 0 }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>