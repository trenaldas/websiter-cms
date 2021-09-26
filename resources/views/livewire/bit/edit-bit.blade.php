<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    @if ($errors->any())
        <div class="relative px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="absolute inset-y-0 left-0 flex items-center ml-4">
            </span>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="mt-2">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Name') }}</span>
                <input type="text" name="name" wire:model="name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
        </div>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">{{ __('Text') }}</span>
            <textarea wire:model="text"
                      class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      rows="5"
            ></textarea>
        </label>
        @include("bit-theme.edit.{$bit->bitTheme->blade}")
        @if($product)
            <div class="mt-2">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">{{ __('Product Code') }}</span>
                    <input type="text" wire:model="code" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div>
            <div class="mt-2">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">{{ __('Price') }}</span>
                    <input type="text" wire:model="price" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div>
        @endif
        @if(count($bit->childrenBits) === 0)
            <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Move to Bit') }}</span>
                <div class="mt-2">
                    <select wire:model="parentId" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="0">{{ __('Parent') }}</option>
                        @foreach($parentBits as $parentBit)
                            @if($parentBit->id !== $bit->id)
                                <option @if($bit->parent_id === $parentBit->id) selected @endif value="{{ $parentBit->id }}">{{ $parentBit->name }} (Page "{{ $parentBit->tag->name }}")</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="mt-2">
            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                <input wire:model="active" type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                <span class="ml-2">{{ __('Active') }}</span>
            </label>
            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                <input wire:model="product" type="checkbox" class="ml-2 text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                <span class="ml-2">{{ __('Product') }}</span>
            </label>
        </div>
        <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            {{ __('Update') }}
        </button>
        <button wire:click.prevent="back" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-purple">
            {{ __('Back') }}
        </button>
        <button wire:click.prevent="deleteConfirm" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
            {{ __('Delete') }}
        </button>
    </form>
    @if(count($bit->childrenBits) > 0)
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Bits Attached') }}
        </h2>
        <ul class="grid gap-6 mb-8 mt-2 md:grid-cols-2 xl:grid-cols-4" wire:sortable="sort">
            @foreach($bit->childrenBits as $bit)
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
                                <a href="{{ route('bit.edit', $bit->id) }}" type="button" class="mr-2 bg-purple-600 text-sm text-white p-2 rounded-full  leading-none flex items-center">
                                    {{ __('Edit') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
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
                    window.livewire.emit('delete');
                }
            })
        })
    </script>
@endpush
