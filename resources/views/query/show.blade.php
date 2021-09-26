@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Query From') }} "{{ $query->name }}"
        </h2>
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Name') }}</span>
                <input value="{{ $query->name }}" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
            <label class="block text-sm mt-2">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Email Address') }}</span>
                <input value="{{ $query->email }}" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
            <label class="block text-sm mt-2">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Phone Number') }}</span>
                <input value="{{ $query->phone }}" disabled class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </label>
            <label class="block mt-4 text-sm mt-2">
                <span class="text-gray-700 dark:text-gray-400">{{ __('Message') }}</span>
                <textarea disabled
                          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          rows="3"
                          placeholder="Enter some long form content."
                >{{ $query->message }}</textarea>
            </label>
            <label class="block mt-4 text-sm">
                <button form="back" class="px-4 py-2 text-sm font-medium  text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                    {{ __('Back') }}
                </button>
                <button form="delete" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    {{ __('Delete') }}
                </button>
            </label>
            <form id="delete" action="{{ route('query.destroy', $query->id) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
            <form id="back" method="GET" action="{{ route('query.index') }}"></form>
        </div>
{{--        <h2 class="my-2 text-2xl font-semibold text-gray-700 dark:text-gray-200">--}}
{{--            {{ __('Reply') }}--}}
{{--        </h2>--}}
{{--        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">--}}
{{--            <label class="block mt-4 text-sm">--}}
{{--                <span class="text-gray-700 dark:text-gray-400">{{ __('Message') }}</span>--}}
{{--                <textarea name="message"--}}
{{--                          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"--}}
{{--                          rows="3"--}}
{{--                ></textarea>--}}
{{--            </label>--}}
{{--            <label class="block mt-4 text-sm">--}}
{{--                <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">--}}
{{--                    {{ __('Reply') }}--}}
{{--                </button>--}}
{{--                <button form="back" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-400 border border-transparent rounded-lg active:bg-purple-600 hover:bg-gray-500 focus:outline-none focus:shadow-outline-purple">--}}
{{--                    {{ __('Back') }}--}}
{{--                </button>--}}
{{--            </label>--}}
{{--        </div>--}}
{{--        <form id="back" method="GET" action="{{ route('query.index') }}"></form>--}}
    </div>
@endsection
