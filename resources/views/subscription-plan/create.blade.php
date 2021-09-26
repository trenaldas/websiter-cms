@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <div class="flex flex-wrap ">
            <div class="px-8 py-6 mx-auto lg:px-10 lg:w-1/2 md:w-full">
                <div class="h-full px-4 py-6 border rounded-xl">
                    <h3 class="tracking-widest">{{ $subscriptionPlan->name }}</h3>
                    <h2 class="flex items-center justify-start mt-2 mb-1 text-3xl font-bold leading-none text-left text-black lg:text-6xl">
                        @money($subscriptionPlan->{$planPeriod})
                        <span class="ml-1 text-base text-gray-600">{{ __('p/m') }}</span>
                    </h2>
                    <span class="text-sm text-gray-400 mb-4">{{ __('Pay Now') }}
                        @if($planPeriod === 'monthly_cost')
                            @money($subscriptionPlan->monthly_cost)
                        @elseif($planPeriod === 'yearly_cost')
                            @money($subscriptionPlan->yearly_cost * 12)
                        @elseif($planPeriod === 'three_years')
                            @money($subscriptionPlan->three_years * 36)
                        @endif
                        </span>
                    <p class="mb-4 text-base leading-relaxed">
                        {{ __('Subscription for Midi plan.') }}
                    </p>
                    <p class="flex items-center mb-2 text-gray-600">
                        <span
                            class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-2 text-white bg-gray-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>{{ __('Websites:') }} {{ $subscriptionPlan->projects }}
                    </p>
                    <p class="flex items-center mb-2 text-gray-600">
                        <span
                            class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-2 text-white bg-gray-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>{{ __('Bits:') }} {{ $subscriptionPlan->bits }}
                    </p>
                    <p class="flex items-center mb-6 text-gray-600">
                        <span
                            class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 mr-2 text-white bg-gray-500 rounded-full">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                 stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </span>{{ __('Photos:') }} {{ $subscriptionPlan->photos }}
                    </p>
                    {{ $checkout->button('Subscribe', ['class' => 'w-full px-8 py-3 mx-auto mt-6 font-semibold text-white transition duration-500 ease-in-out transform bg-purple-600 rounded-lg hover:bg-purple-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2']) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    </script>
@endpush
