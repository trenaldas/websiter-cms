<div class="shadow overflow-hidden sm:rounded-lg">
    <div class="border-t border-gray-200 dark:border-gray-800">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                <dt class="text-sm font-medium text-gray-500">
                    {{ __('Full Name') }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                    {{ auth()->user()->full_name }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                <dt class="text-sm font-medium text-gray-500">
                    {{ __('Email Address') }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                    {{ auth()->user()->email }}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                <dt class="text-sm font-medium text-gray-500">
                    {{ __('Subscription Plan') }}
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                    <span class="font-bold">{{ $currentSubscriptionPlan->name }}</span>
                </dd>
            </div>
        </dl>
    </div>
    @if($currentSubscriptionPlan->id === 1)
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900 dark:text-gray-300">{{ __('Pricing') }}</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-gray-500">{{ __('Websiter with Tiny Prices. If free plan is not enough, we have plan that will satisfy everyone.') }}</p>
                <div class="flex mx-auto border-2 border-indigo-500 rounded overflow-hidden mt-6 dark:text-gray-300">
                    <button wire:click="$set('plan', 'monthly_cost')" class="py-1 px-4 @if($plan === 'monthly_cost') bg-indigo-500 text-white @endif focus:outline-none">{{ __('Monthly') }}</button>
                    <button wire:click="$set('plan', 'yearly_cost')" class="py-1 px-4 @if($plan === 'yearly_cost') bg-indigo-500 text-white @endif focus:outline-none">{{ __('Yearly') }}</button>
                    <button wire:click="$set('plan', 'three_years')" class="py-1 @if($plan === 'three_years') bg-indigo-500 text-white @endif px-4 focus:outline-none">{{ __('Three Years') }}</button>
                </div>
            </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach($subscriptionPlans as $subscriptionPlan)
                    <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                        <div class="h-full p-6 rounded-lg border-2 @if($currentSubscriptionPlan->id === $subscriptionPlan->id) border-purple-300 @else border-yellow-300 @endif flex flex-col relative overflow-hidden">
                            @if($currentSubscriptionPlan->id === $subscriptionPlan->id)
                                <span class="bg-purple-300 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl dark:text-gray-300">{{ __('CURRENT') }}</span>
                            @endif
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium dark:text-gray-300">{{ strtoupper($subscriptionPlan->name) }}</h2>
                            <h1 class="text-5xl text-gray-900 pb-2 mb-2 border-b border-gray-200 leading-none dark:text-gray-300">
                                @if($subscriptionPlan->{$plan} > 0)
                                    @money($subscriptionPlan->{$plan}) {{ __('p/m') }}
                                    <br>
                                    <span class="text-xs text-gray-600">{{ __('Pay now ') }}
                                        @if($plan === 'monthly_cost')
                                            @money($subscriptionPlan->{$plan})
                                        @elseif($plan === 'yearly_cost')
                                            @money($subscriptionPlan->{$plan} * 12)
                                        @elseif($plan === 'three_years')
                                            @money($subscriptionPlan->{$plan} * 36)
                                        @endif
                                    </span>
                                @else
                                    {{ __('FREE') }}
                                @endif
                            </h1>
                            <p class="flex items-center text-gray-600 mb-2 dark:text-gray-300">
                                <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-yellow-400 text-white rounded-full flex-shrink-0">
                                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                  </svg>
                                </span>{{ $subscriptionPlan->projects }} {{ __('Project Allowance') }}
                            </p>
                            <p class="flex items-center text-gray-600 mb-2 dark:text-gray-300">
                                <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-yellow-400 text-white rounded-full flex-shrink-0">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>{{ $subscriptionPlan->bits }} {{ __('Bit Allowance') }}
                            </p>
                            <p class="flex items-center text-gray-600 mb-2 dark:text-gray-300">
                                <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-yellow-400 text-white rounded-full flex-shrink-0">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                        <path d="M20 6L9 17l-5-5"></path>
                                    </svg>
                                </span>{{ $subscriptionPlan->photos }} {{ __('Photos Allowance') }}
                            </p>
                            @if($currentSubscriptionPlan->id !== $subscriptionPlan->id)
                                <button wire:click="subscribe({{$subscriptionPlan->id}})" class="flex items-center mt-auto text-white bg-yellow-600 border-0 py-2 px-4 w-full focus:outline-none hover:bg-yellow-500 rounded">
                                    {{ __('Subscribe') }}
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
