@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Queries') }}
        </h2>
        @if(count($queries) > 0)
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">{{ __('Customer') }}</th>
                                <th class="px-4 py-3">{{ __('Replied') }}</th>
                                <th class="px-4 py-3">{{ __('Date') }}</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($queries as $query)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
{{--                                            <img class="object-cover w-full h-full rounded-full" src="{{ asset('img/default_logo.png') }}" alt="Project Logo" loading="lazy"/>--}}
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $query->name }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $query->project->title }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight rounded-full @if($query->replied) text-green-700 dark:bg-green-700 bg-green-100  @else text-red-700 dark:bg-red-700 bg-red-100  @endif dark:text-green-100">
                                  @if($query->replied) {{ __('Yes') }}  @else {{ __('No') }}  @endif
                                </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $query->created_at }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('query.show', $query->id) }}" class="px-1 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        {{ __('Show') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    {{ $queries->links('livewire.pagination') }}
                </div>
            </div>
        @else
            <div class="mb-2 px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
                <p>{{ __('No queries received.') }}</p>
            </div>
        @endif
    </div>
@endsection
