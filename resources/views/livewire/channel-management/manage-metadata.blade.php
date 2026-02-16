<div class="p-6 bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="saveMetadata" class="space-y-4">
        <div>
            <label for="seoTitle" class="block text-sm font-medium">SEO Title</label>
            <input type="text" id="seoTitle" wire:model="seoTitle" class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:border sm:text-sm">
            @error('seoTitle') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="seoDescription" class="block text-sm font-medium">SEO Description</label>
            <textarea id="seoDescription" wire:model="seoDescription" class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:border sm:text-sm"></textarea>
            @error('seoDescription') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tags" class="block text-sm font-medium">Tags</label>
            <input type="text" id="tags" wire:model="tags" placeholder="Comma separated tags" class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:border sm:text-sm">
            @error('tags') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring">Save Metadata</button>
    </form>
</div>