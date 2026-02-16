<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Schedule Conflicts</h1>
    <button wire:click="checkConflicts" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Check for Conflicts</button>

    @if (!empty($conflicts))
        <ul class="mt-4 space-y-2">
            @foreach($conflicts as $conflict)
                <li class="p-2 bg-red-100 text-red-800 rounded">{{ $conflict }}</li>
            @endforeach
        </ul>
    @else
        <p class="mt-4 text-green-600">No conflicts detected.</p>
    @endif
</div>