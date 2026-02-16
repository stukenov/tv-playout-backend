<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Media Library</h2>

    <div class="mb-4">
        <input wire:model.debounce.300ms="search" type="text" placeholder="Search media..." class="w-full px-4 py-2 border rounded-lg">
    </div>

    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('file_name')">File Name</th>
                <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('file_type')">Type</th>
                <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('file_size')">Size</th>
                <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('upload_date')">Upload Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($media as $item)
                <tr>
                    <td class="px-4 py-2">{{ $item->file_name }}</td>
                    <td class="px-4 py-2">{{ $item->file_type }}</td>
                    <td class="px-4 py-2">{{ $item->file_size }}</td>
                    <td class="px-4 py-2">{{ $item->upload_date }}</td>
                    <td class="px-4 py-2">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                            Edit
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $media->links() }}
    </div>
</div>