<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        {{ __('Create Project') }}
    </h2>
    @if ($errors->any())
        <div class="relative px-4 py-3 mb-2 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="absolute inset-y-0 left-0 flex items-center ml-4">
            </span>
            <p class="ml-6">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </p>
        </div>
    @endif
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form wire:submit.prevent="store" method="POST">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Title') }}</span>
                <input wire:model="title" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
            <div class="grid mt-2 gap-5 lg:grid-cols-2 sm:max-w-sm sm:mx-auto lg:max-w-full">
                <div class="mt-4">
                    <div class="text-gray-700 dark:text-gray-400 font-medium">
                        <input wire:model="domain"
                            type="radio"
                               class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                               name="domain"
                               value="0"
                        />
                        {{ __('Websiter Subdomain') }}
                    </div>
                    <div class="mt-2 mb-4">
                        <label class="block text-sm">
                            <input wire:model="subdomain_url" @if($domain) disabled @endif class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                    <span class="text-sm">{{ __('Example: MyShop.tnyweb.com') }}</span>
                </div>
                <div class="mt-4">
                    <div class="text-gray-700 dark:text-gray-400 font-medium">
                        <input wire:model="domain"
                            type="radio"
                               class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                               name="domain"
                               value="1"
                        />
                      {{ __('Your Own Domain') }}
                    </div>
                    <div class="mt-2 mb-4">
                        <label class="block text-sm">
                            <input wire:model="domain_url" @if(!$domain) disabled @endif class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </label>
                    </div>
                    <span class="text-sm">
                        <p class="mb-1">Example: MyShop.com</p>
                        <p>Configuration details:</p>
                        <ol>
                            <li>
                                1. You must own the Domain Name to be able to use it. You can buy your domain at https://www.namecheap.com.
                            </li>
                            <li>
                                2. Once you own a Domain Name, please add this to your Domain Name DNS Config:
                                <br>@,A,75.2.70.75"
                                <br>@ - stands for master record
                                <br>A - stands for http/https
{{--                                //todo change this--}}
                                <br>0.0.0.0 - is our Websiter Server IP address
                                <br>* do not change nameservers of your Domain Provider, for "Name Cheap" provider nameservers are: ns1.namecheap.com and etc.
                            </li>
                        </ol>
                    </span>
                </div>
            </div>
            <button type="submit" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                {{ __('Create') }}
            </button>
            <button wire:click="cancel" form="cancel" class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-400 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-500 focus:outline-none focus:shadow-outline-gray">
                {{ __('Cancel') }}
            </button>
        </form>
    </div>
</div>
