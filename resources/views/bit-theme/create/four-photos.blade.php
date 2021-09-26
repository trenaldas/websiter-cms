<div class="mt-2 inline-flex">
    <label class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        <svg class="w-5 h-5" aria-hidden="true" fill="none"stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <span class="ml-1 cursor-pointer">{{ __('Upload Photos') }} {{ count($photos ?? []) }}/4</span>
        <input multiple accept="image/png, image/jpeg" wire:model="photos" type="file" class="hidden"/>
    </label>
</div>
<div class="grid mt-2 gap-5 lg:grid-cols-4 sm:max-w-sm sm:mx-auto lg:max-w-full">
    @if(isset($photos[0]))
        <div class="overflow-hidden transition-shadow duration-300 bg-white rounded">
            <img src="{{ $photos[0]->temporaryUrl() }}" class="object-cover w-full h-64 rounded" alt="photo"/>
        </div>
    @endif
    @if(isset($photos[1]))
        <div class="overflow-hidden transition-shadow duration-300 bg-white rounded">
            <img src="{{ $photos[1]->temporaryUrl() }}" class="object-cover w-full h-64 rounded" alt="photo"/>
        </div>
    @endif
    @if(isset($photos[2]))
        <div class="overflow-hidden transition-shadow duration-300 bg-white rounded">
            <img src="{{ $photos[2]->temporaryUrl() }}" class="object-cover w-full h-64 rounded" alt="photo"/>
        </div>
    @endif
    @if(isset($photos[3]))
        <div class="overflow-hidden transition-shadow duration-300 bg-white rounded">
            <img src="{{ $photos[3]->temporaryUrl() }}" class="object-cover w-full h-64 rounded" alt="photo"/>
        </div>
    @endif
</div>
