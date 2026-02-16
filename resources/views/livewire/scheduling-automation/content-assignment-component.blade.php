<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Content Assignment</h1>
    <div class="schedules space-y-6">
        @foreach($schedules as $schedule)
            <div class="schedule bg-white shadow-md rounded-lg p-4" wire:key="schedule-{{ $schedule->id }}">
                <h2 class="text-2xl font-medium text-gray-700 mb-4">{{ $schedule->name }}</h2>
                <div class="contents space-y-2">
                    @foreach($contents as $content)
                        <div class="content bg-gray-50 border border-gray-200 rounded-lg p-2 cursor-move" draggable="true" wire:dragstart="assignContent({{ $schedule->id }}, {{ $content->id }})">
                            {{ $content->title }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    @if (session()->has('message'))
        <div class="mt-6 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
</div>