<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="description" content="{{ __('Create your Website at no Cost. Always') }}">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
              integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
              crossorigin="anonymous"
        />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <div class="container mx-auto py-20 px-2 max-w-6xl">
        <div class="grid md:grid-cols-7 gap-4">
            <div class="md:col-span-4 tracking-wider">
                <h1 class="text-6xl font-bold font-logo">Websiter</h1>
                <div class="text-xl py-2">{{ __('Your Website Builder.') }} <span class="text-purple-600 font-bold">{{ __('Always Free!') }}</span></div>
                <br />
                <div class="py-1">
                    @auth()
                        <a href="{{ route('project.index') }}"
                           class="bg-purple-600 rounded-full text-white md:px-8 px-6 py-3 transition duration-300 ease-in-out hover:bg-purple-700 mr-6">
                            {{ __('CMS') }} &xrarr;
                        </a>
                    @endauth
                    @guest()
                        <a href="{{ route('register') }}"
                           class="bg-purple-600 rounded-full text-white md:px-8 px-6 py-3 transition duration-300 ease-in-out hover:bg-purple-700 mr-6">
                            {{ __('Free Website in 3 minutes') }} &xrarr;
                        </a>
                    @endguest()
                </div>
                <div class="py-10">
                    &check; {{ __('No Ads') }}
                    <br />
                    &check; {{ __('Connect your own domain') }}
                    <br />
                    &check; {{ __('No hidden fees') }}
                </div>
            </div>
            <div class="md:col-span-3 align-middle">
                <img src="{{ asset('img/donuty@2x.png') }}" style="width:100%;">
            </div>
        </div>
        <hr class="mt-20 mb-2 border-0 bg-gray-200 text-gray-500 h-px">
        <div class="tracking-wide">
            <a class="mr-2" href="#">
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
            <a href="{{ route('contact-us') }}">
                {{ __('Contact Us') }}
            </a>
        </div>
    </div>
</html>




