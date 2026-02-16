<div class="p-4 bg-white rounded shadow-md">
    <form wire:submit.prevent="assignContent" class="space-y-4">
        <div>
            <label for="selectedContent" class="block text-sm font-medium text-gray-700">Select Content</label>
            <select id="selectedContent" wire:model="selectedContent" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">Choose content</option>
                @foreach($contents as $content)
                    <option value="{{ $content->id }}">{{ $content->title }}</option>
                @endforeach
            </select>
            @error('selectedContent') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Assign Content</button>
    </form>

    <h3 class="mt-6 text-lg font-medium text-gray-900">Assigned Contents</h3>
    <ul class="mt-2 space-y-2">
        @foreach($channelContents as $content)
            <li class="p-2 bg-gray-100 rounded">{{ $content->title }}</li>
        @endforeach
    </ul>
</div>