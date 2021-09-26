<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        {{ __('Your Orders') }}
    </h2>
    @if(session('message'))
        <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    <div class="mt-4 text-sm">
        <div class="mt-2">
            <select wire:model="findByStatus" class="mb-2 text-sm focus:outline-none dark:text-gray-300 dark:bg-gray-700 form-select">
                <option value="pending">{{ __('Pending') }}</option>
                <option value="in_progress">{{ __('In Progress') }}</option>
                <option value="completed">{{ __('Completed') }}</option>
                <option value="cancelled">{{ __('Cancelled') }}</option>
                <option value="refunded">{{ __('Refunded') }}</option>
            </select>
        </div>
    </div>
    @if($orders->count())
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">{{ __('Customer') }}</th>
                            <th class="px-4 py-3">{{ __('Email') }}</th>
                            <th class="px-4 py-3">{{ __('Amount') }}</th>
                            <th class="px-4 py-3">{{ __('Date') }}</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($orders as $order)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold">{{ $order->full_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{ $order->email }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @money($order->orderItems->sum('order_item_full_cost') + ($order->shippingMethod->price ?? 0), $currency)
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $order->created_at->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('order.show', $order->id) }}" class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        {{ __('Show') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    {{ $orders->onEachSide(3)->links('livewire.pagination') }}
                </div>
            </div>
        </div>
    @else
        <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
            <p>{{ __('No orders :status found.', ['status' => ucwords(str_replace('_', ' ', $findByStatus))]) }}</p>
        </div>
    @endif
</div>
