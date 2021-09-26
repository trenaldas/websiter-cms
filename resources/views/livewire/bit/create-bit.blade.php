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
    <form wire:submit.prevent="store" enctype="multipart/form-data">
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
        @include("bit-theme.create.{$bitTheme->blade}")
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
        <div class="mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">{{ __('Move to Bit') }}</span>
            <div class="mt-2">
                <select wire:model="parentId" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <option value="0">{{ __('Parent') }}</option>
                    @foreach($parentBits as $parentBit)
                        <option value="{{ $parentBit->id }}">{{ $parentBit->name }} (Page "{{ $parentBit->tag->name }}")</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-2">
            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                <input wire:model="active" type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                <span class="ml-2">{{ __('Set Active') }}</span>
            </label>
            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                <input wire:model="product" type="checkbox" class="ml-2 text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                <span class="ml-2">{{ __('Product') }}</span>
            </label>
        </div>
        <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            {{ __('Create') }}
        </button>
        <button wire:click.prevent="back" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-purple">
            {{ __('Back') }}
        </button>
        <input type="hidden" wire:model="tag_id" value="{{ $tagId }}">
        <input type="hidden" wire:model="bit_theme_id" value="{{ $bitTheme->id }}">
    </form>
</div>
