<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        {{ __('Order - ') }} #{{ $order->orderId }}
    </h2>
    @if(session('message'))
        <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <div class="shadow overflow-hidden sm:rounded-lg">
        <div class="border-t border-gray-200 dark:border-gray-800">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Full Name') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        {{ $order->full_name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6  dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Email Address') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2  dark:text-gray-300">
                        {{ $order->email }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Phone') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        {{ $order->phone }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Address') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        {{ $order->street_name }},
                        {{ $order->city }},
                        {{ $order->country }},
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Additional Details') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        {{ $order->details }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('SubTotal Price') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        @money($totalCost, $currency)
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Shipping') }}
                    </dt>
                    @if($order->shippingMethod)
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                            @money($order->shippingMethod->price, $currency) {{ $order->shippingMethod->name }}
                            @if($order->shippingMethod->trashed())
                                <span class="text-xs">({{ __('Method removed') }})</span>
                            @endif
                        </dd>
                    @else
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                            {{ __('No Shipping Method') }}
                        </dd>
                    @endif
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Total') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 dark:text-gray-300">
                        @money($totalCost + ($order->shippingMethod->price ?? 0), $currency)
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 dark:text-gray-300 dark:bg-gray-700">
                    <dt class="text-sm font-medium text-gray-500">
                        {{ __('Status') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select wire:model="status" wire:self.prevent class="mb-2 text-sm focus:outline-none dark:text-gray-300 dark:bg-gray-700 form-select">
                            <option value="pending">{{ __('Pending') }}</option>
                            <option value="in_progress">{{ __('In Progress') }}</option>
                            <option value="completed">{{ __('Completed') }}</option>
                            <option value="cancelled">{{ __('Cancelled') }}</option>
                            <option value="refunded">{{ __('Refunded') }}</option>
                        </select>
                        <button wire:click="updateStatus" class="mb-4 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            {{ __('Update') }}
                        </button>
                    </dd>
                </div>
            </dl>
        </div>
        <div class="w-full overflow-hidden shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">{{ __('Item') }}</th>
                            <th class="px-4 py-3">{{ __('Quantity') }}</th>
                            <th class="px-4 py-3">{{ __('Price') }}</th>
                            <th class="px-4 py-3">{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($order->orderItems as $orderItem)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold">
                                                @if($orderItem->bit->trashed())
                                                    {{ $orderItem->bit->name }} <span class="text-xs text-gray-400">{{ __('Bit deleted') }}</span>
                                                @else
                                                    <a href="{{ route('bit.edit', $orderItem->bit_id) }}">{{ $orderItem->bit->name }}</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @money($orderItem->quantity, $currency)
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @money($orderItem->bit_price, $currency)
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @money($orderItem->bit_price * $orderItem->quantity, $currency)
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
