<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
    @if($message)
        <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if($errors->any())
        <div class="relative px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
        <span class="absolute inset-y-0 left-0 flex items-center ml-4">
        </span>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </div>
    @endif
    <form wire:submit.prevent="update" method="post">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">{{ __('Name') }}</span>
            <input type="text" wire:model="name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
        </label>
        <div class="mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">{{ __('Description') }}</span>
            <div class="mt-2">
                <label class="block text-sm">
                    <input type="text" wire:model="description" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                </label>
            </div>
        </div>
        @if(count($tag->childrenTags) === 0)
            <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Move to') }}</span>
                <div class="mt-2">
                    <select wire:model="parent_id" @if(!$showParentInput) disabled @endif class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <option value="0">{{ __('Parent') }}</option>
                        @foreach($parentTags as $parentTag)
                            @if($parentTag->id !== $tag->id && $parentTag->home === 0)
                                <option @if($tag->parent_id === $parentTag->id) selected @endif value="{{ $parentTag->id }}">{{ $parentTag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="mt-2">
            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                <input wire:model="active" @if($home) disabled @endif type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                <span class="ml-2">{{ __('Set Active') }}</span>
            </label>
            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                <input  wire:model="home" @if(!$showHomeSelect || $disableHomeCheck) disabled @endif type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"/>
                <span class="ml-2">{{ __('Set as homepage') }}</span>
            </label>
        </div>
        <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            {{ __('Update') }}
        </button>
        <button form="cancel" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
            {{ __('Cancel') }}
        </button>
    </form>
    <form id="cancel" method="GET" action="{{ route('tag.index') }}"></form>
</div>
