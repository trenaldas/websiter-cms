<div>
    @if(session('message'))
        <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <button wire:click="create" @cannot('create', \App\Models\Bit::class) disabled @endcannot class="mb-4 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md @can('create', \App\Models\Bit::class) active:bg-purple-600 hover:bg-purple-700 @endcan focus:outline-none focus:shadow-outline-purple">
        {{ __('Create') }}
    </button>
    <ul class="grid gap-6 mb-8 mt-2 md:grid-cols-2 xl:grid-cols-4" wire:sortable="sort">
        @foreach($bits as $bit)
            <li wire:sortable.item="{{ $bit->id }}" wire:key="bit-{{ $bit->id }}">
                <div wire:sortable.handle class="cursor-pointer flex items-center p-4 @if($bit->active) bg-blue-100 @else bg-white @endif rounded-lg shadow-xs dark:text-white dark:bg-gray-800">
                    <div>
                        <span class="text-sm font-medium">{{ $bit->bitTheme->name }}</span>
                        <h1 class="text-black mb-2 font-bold text-gray-600 dark:text-gray-400">
                            {{ $bit->name }}
                        </h1>
                        <div class="flex md:flex">
                            @if($bit->active)
                                <button type="button" class="mr-2 bg-green-600 text-sm text-white p-2 rounded-full leading-none flex items-center">
                                    {{ __('Active') }}
                                </button>
                            @else
                                <button type="button" class="mr-2 bg-red-600 text-sm text-white p-2 rounded-full leading-none flex items-center">
                                    {{ __('Inactive') }}
                                </button>
                            @endif
                            <div type="button" class="mr-2 bg-indigo-600 text-sm text-white p-2 rounded-full  leading-none flex items-center">
                                {{ $bit->children_bits_count }}
                            </div>
                            <a href="{{ route('bit.edit', $bit->id) }}" type="button" class="mr-2 bg-purple-600 hover:bg-purple-800 text-sm text-white p-2 rounded-full  leading-none flex items-center">
                                {{ __('Edit') }}
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
