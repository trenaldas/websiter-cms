<div class="grid mt-2 gap-5 lg:grid-cols-4 sm:max-w-sm sm:mx-auto lg:max-w-full">
    @foreach($bit->getMedia() as $media)
        <div class="overflow-hidden transition-shadow duration-300 bg-white rounded">
            <img src="{{ $media->getFullUrl() }}" class="object-cover w-full h-64 rounded" alt="" />
        </div>
    @endforeach
</div>
