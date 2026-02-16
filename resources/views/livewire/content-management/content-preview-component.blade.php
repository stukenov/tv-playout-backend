<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Content Preview</h2>

    <div class="mb-4">
        <h3 class="text-lg font-semibold mb-2">{{ $media->file_name }}</h3>
        <p class="text-gray-600">Type: {{ $media->file_type }}</p>
    </div>

    <div class="mb-4">
        @switch($this->mediaType)
            @case('video')
                <video controls class="w-full max-w-2xl mx-auto">
                    <source src="{{ $media->storage_url }}" type="{{ $media->file_type }}">
                    Your browser does not support the video tag.
                </video>
                @break

            @case('audio')
                <audio controls class="w-full max-w-2xl mx-auto">
                    <source src="{{ $media->storage_url }}" type="{{ $media->file_type }}">
                    Your browser does not support the audio tag.
                </audio>
                @break

            @case('image')
                <img src="{{ $media->storage_url }}" alt="{{ $media->file_name }}" class="max-w-full h-auto mx-auto">
                @break

            @default
                <p class="text-red-500">Preview not available for this file type.</p>
        @endswitch
    </div>

    <div class="mt-4">
        <a href="{{ $media->storage_url }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Open in New Tab
        </a>
    </div>
</div>