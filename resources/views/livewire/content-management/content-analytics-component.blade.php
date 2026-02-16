<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Content Analytics</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">{{ $media->file_name }}</h3>
        <p class="text-gray-600">Type: {{ $media->file_type }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-2">Total Views</h4>
            <p class="text-3xl font-bold">{{ $viewCount }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold mb-2">Total Downloads</h4>
            <p class="text-3xl font-bold">{{ $downloadCount }}</p>
        </div>
    </div>

    <div class="mb-8">
        <h4 class="text-lg font-semibold mb-2">Usage Over Time</h4>
        <div class="bg-white p-4 rounded-lg shadow">
            <canvas id="usageChart" width="400" height="200"></canvas>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('usageChart').getContext('2d');
            var usageData = @json($usageByDay);
            
            var labels = usageData.map(item => item.date);
            var data = usageData.map(item => item.count);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Usage Count',
                        data: data,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</div>