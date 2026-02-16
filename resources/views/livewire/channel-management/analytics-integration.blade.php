<div class="p-4 bg-white shadow rounded-lg">
    <h3 class="text-lg font-semibold mb-4">Channel Analytics</h3>
    <ul class="list-disc pl-5 space-y-2">
        @foreach($analyticsData as $key => $value)
            <li class="text-gray-700"><span class="font-medium">{{ ucfirst($key) }}:</span> {{ $value }}</li>
        @endforeach
    </ul>
</div>