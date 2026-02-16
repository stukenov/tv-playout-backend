<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Version Control</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Current Version: {{ $currentVersion }}</h3>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">Version History</h3>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Version</th>
                    <th class="py-2 px-4 border-b">Created At</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($versions as $version)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $version->version_number }}</td>
                        <td class="py-2 px-4 border-b">{{ $version->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($version->version_number !== $currentVersion)
                                <button
                                    wire:click="revertToVersion({{ $version->id }})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm mr-2"
                                >
                                    Revert
                                </button>
                                <button
                                    wire:click="deleteVersion({{ $version->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm"
                                >
                                    Delete
                                </button>
                            @else
                                <span class="text-green-500 font-semibold">Current</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @error('deleteVersion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>