<div class="px-4 py-3 mb-8 rounded-lg shadow-md dark:bg-gray-800">
    @if(session('message'))
        <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <a href="{{ route('tag.create') }}" class="mb-4 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        {{ __('Create') }}
    </a>
    <ul class="mt-2" wire:sortable="sort" wire:sortable-group="sortSubTag">
        @foreach($tags as $tag)
            <li wire:sortable.item="{{ $tag->id }}" wire:key="task-{{ $tag->id }}">
            <div class="cursor-pointer flex items-center justify-between p-4 mb-2 text-sm font-semibold text-purple-100 @if($tag->active) bg-blue-500 @else bg-gray-400 @endif rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
                <div class="flex items-center">
                    <span>{{ $tag->name }} @if($tag->home) ({{ __('HOME') }}) @endif</span>
                </div>
                <span>
                    <div class="flex items-center text-sm">
                        <a href="{{ route('tag.bits', $tag->id) }}"><span class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-blue-400 rounded-full hover:bg-blue-700">{{ __('Contain Bits') }} {{ count($tag->bits) }}</span></a>
                        <button wire:click="edit({{$tag->id }})" class="flex items-center justify-between px-2 text-sm font-medium leading-5 hover:text-pink-200 text-purple-600 rounded-lg dark:text-white focus:outline-none">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                           </svg>
                        </button>
                        <button wire:click="deleteConfirm({{$tag->id }})" class="flex items-center justify-between px-2 text-sm font-medium leading-5 hover:text-pink-200 text-purple-600 rounded-lg dark:text-white focus:outline-none">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </span>
            </div>
{{--            <ul wire:sortable-group.item-group="{{ $tag->id }}">--}}
                @foreach($tag->childrenTags as $childrenTag)
{{--                    <li wire:key="task-{{ $childrenTag->id }}" wire:sortable-group.item="{{ $childrenTag->id }}">--}}
                        <div class="cursor-pointer w-9/12 flex items-center justify-between p-4 mb-2 text-sm font-semibold text-white @if($childrenTag->active) bg-blue-300 @else bg-gray-400 @endif rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
                            <div class="flex items-center">
                                <span>{{ $childrenTag->name }}</span>
                            </div>
                            <span>
                                <div class="flex items-center text-sm">
                                    <a href="{{ route('tag.bits', $childrenTag->id) }}"><span class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-blue-400 rounded-full hover:bg-blue-700">{{ __('Contain Bits') }} {{ count($childrenTag->bits) }}</span></a>
                                    <button wire:click="edit({{$childrenTag->id }})" class="flex items-center justify-between px-2 text-sm font-medium leading-5 hover:text-pink-200 text-purple-600 rounded-lg dark:text-white focus:outline-none">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                       </svg>
                                    </button>
                                    <button wire:click="deleteConfirm({{$childrenTag->id }})" class="flex items-center justify-between px-2 text-sm font-medium leading-5 hover:text-pink-200 text-purple-600 rounded-lg dark:text-white focus:outline-none">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </span>
                        </div>
{{--                    </li>--}}
                @endforeach
{{--            </ul>--}}
            </li>
        @endforeach
    </ul>
</div>

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        window.addEventListener('swal:confirm', event => {
            swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit('delete', event.detail.id);
                    }
                })
        })
    </script>
@endpush
