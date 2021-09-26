<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="{{ __('Create your Webister at no Cost. Always') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <div class="container mx-auto py-20 px-2 max-w-6xl">
        <div class="grid md:grid-cols-7 gap-4">
            <div class="md:col-span-4 tracking-wider">
                <h1 class="text-6xl font-bold font-logo">Websiter</h1>
                <div class="text-xl py-2">{{ __('Create your Webister at no Cost. Always.') }}</div>
                <br />
                <form action="{{ route('admin-query.store') }}" method="POST">
                    @csrf
                    <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">{{ __('Name') }}</span>
                            <input name="name" value="{{ old('name') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            @error('name')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                  {{ $message }}
                                </span>
                            @enderror
                        </label>
                    </div>
                    <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">{{ __('Email') }}</span>
                            <input name="email" value="{{ old('email') }}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                            @error('email')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>
                    </div>
                    <div class="px-4 py-3 mb-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">{{ __('Message') }}</span>
                            <textarea name="message" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="md:col-span-3 align-middle">
                <img src="{{ asset('img/donuty@2x.png') }}">
            </div>
        </div>
        <hr class="mt-20 mb-2 border-0 bg-gray-200 text-gray-500 h-px">
        <div class="tracking-wide">
            <a class="mr-2" href="{{ route('welcome') }}">
                {{ __('Home') }}
            </a>
            @auth()
                <a class="mr-2" href="{{ route('project.index') }}">
                    {{ __('CMS') }}
                </a>
            @endauth()
            @guest
                <a class="mr-2" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            @endguest
            <a href="#">
                {{ __('Contact Us') }}
            </a>
        </div>
    </div>
</html>




