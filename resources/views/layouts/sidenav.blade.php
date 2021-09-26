<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ route('tag.index') }}">
            Website Builder
        </a>
        @if(auth()->user()->selectedProject)
            <div class="ml-6 text-lg font-bold text-purple-800 dark:text-gray-200">{{ auth()->user()->selectedProject->title }}
                <a href="@if(auth()->user()->selectedProject->domain_url)
                            https://{{ auth()->user()->selectedProject->domain_url }}
                         @else
                            https://{{ auth()->user()->selectedProject->subdomain_url }}.websiter.com
                         @endif"
                   class="text-xs text-gray-400"
                   target="_blank">
                    {{ __('Visit') }}
                </a>
            </div>
        @endif
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if(count($navTags) > 0 && $activeNav > 0)
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <ul class="p-2 mb-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-blue-100 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
                    @if(auth()->user()->selectedProject)
                        @if(count($navTags) > 0)
                            <li class="px-2 py-1 transition-colors duration-150 text-indigo-800">
                                <div class="w-full">{{ __('Pages') }}</div>
                            </li>
                            @foreach($navTags as $navTag)
                                <li class="px-2 py-1 transition-colors @if($activeNav === $navTag->id) text-pink-600 @endif">
                                    <a class="w-full duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                                       href="@if(!$navTag->hasChildren()){{ route('tag.bits', $navTag) }} @else # @endif">
                                        {{ $navTag->name }}
                                    </a>
                                    @if(! $navTag->hasChildren())
                                        <span>({{ $navTag->bits->count() }})</span>
                                    @endif
                                </li>
                                @foreach($navTag->childrenTags as $navChildrenTag)
                                    @if($navChildrenTag->active)
                                        <li class="px-6 py-1 transition-colors @if($activeNav === $navChildrenTag->id) text-pink-600 @endif ">
                                            <a class="w-full duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{ route('tag.bits', $navChildrenTag) }}">{{ $navChildrenTag->name }}</a>
                                            <span>({{ $navChildrenTag->bits->count() }})</span>
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <li class="px-6 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="{{ route('tag.index') }}">{{ __('No Pages') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="px-6 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="{{ route('project.index') }}">{{ __('Crete Or Select Project') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                @if(request()->routeIs(['tag.index', 'tag.create']))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('tag.index') }}" class="@if(request()->routeIs(['tag.index', 'tag.create'])) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span class="ml-4">{{ __('Pages') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('order*'))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('order.index') }}" class="@if(request()->routeIs('order*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span class="ml-4">{{ __('Orders') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('shipping-method*'))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('shipping-method.index') }}" class="@if(request()->routeIs('shipping-method*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span class="ml-4">{{ __('Shipping') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('query*'))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('query.index') }}" class="@if(request()->routeIs('query*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">{{ __('Queries') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('project.config*'))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('project.config.index') }}" class="@if(request()->routeIs('project.config*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="ml-4">{{ __('Config') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs(['project.index', 'project.create', 'project.edit']))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('project.index') }}" class="@if(request()->routeIs(['project.index', 'project.create', 'project.edit'])) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                    </svg>
                    <span class="ml-4">{{ __('Projects') }}</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<div x-show="isSideMenuOpen"
     x-transition:enter="transition ease-in-out duration-150"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in-out duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
       x-show="isSideMenuOpen"
       x-transition:enter="transition ease-in-out duration-150"
       x-transition:enter-start="opacity-0 transform -translate-x-20"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in-out duration-150"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0 transform -translate-x-20"
       @click.away="closeSideMenu"
       @keydown.escape="closeSideMenu"
>
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            {{ config('app.name') }}
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if(count($navTags) > 0 && $activeNav > 0)
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <ul class="p-2 mb-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-blue-100 dark:text-gray-400 dark:bg-gray-900" aria-label="submenu">
                    @if(auth()->user()->selectedProject)
                        @if(count($navTags) > 0)
                            <li class="px-2 py-1 transition-colors duration-150 text-indigo-800">
                                <div class="w-full">{{ __('Pages') }}</div>
                            </li>
                            @foreach($navTags as $navTag)
                                <li class="px-2 py-1 transition-colors @if($activeNav === $navTag->id) text-pink-600 @endif duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{ route('tag.bits', $navTag) }}">{{ $navTag->name }}</a>
                                </li>
                                @foreach($navTag->childrenTags as $navChildrenTag)
                                    @if($navChildrenTag->active)
                                        <li class="px-6 py-1 transition-colors @if($activeNav === $navChildrenTag->id) text-pink-600 @endif duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                            <a class="w-full" href="{{ route('tag.bits', $navChildrenTag) }}">{{ $navChildrenTag->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <li class="px-6 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                <a class="w-full" href="{{ route('tag.index') }}">{{ __('No Pages') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="px-6 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="{{ route('project.index') }}">{{ __('Crete Or Select Project') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                @if(request()->routeIs(['tag.index', 'tag.create'])) <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"aria-hidden="true"></span> @endif
                <a href="{{ route('tag.index') }}" class="@if(request()->routeIs(['tag.index', 'tag.create'])) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span class="ml-4">{{ __('Pages') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('order*'))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('order.index') }}" class="@if(request()->routeIs('order*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span class="ml-4">{{ __('Orders') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('shipping-method*'))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('shipping-method.index') }}" class="@if(request()->routeIs('shipping-method*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                    </svg>
                    <span class="ml-4">{{ __('Shipping') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('query*'))<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>@endif
                <a href="{{ route('query.index') }}" class="@if(request()->routeIs('query*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">{{ __('Queries') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs('project.config*')) <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"aria-hidden="true"></span> @endif
                <a href="{{ route('project.config.index') }}" class="@if(request()->routeIs('project.config*')) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg class="w-5 h-5"
                         aria-hidden="true"
                         fill="none"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                    >
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    <span class="ml-4">{{ __('Config') }}</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if(request()->routeIs(['project.index', 'project.create', 'project.edit'])) <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"aria-hidden="true"></span> @endif
                <a href="{{ route('project.index') }}" class="@if(request()->routeIs(['project.index', 'project.create', 'project.edit'])) text-gray-800 dark:text-gray-100 @endif inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                        ></path>
                    </svg>
                    <span class="ml-4">{{ __('Projects') }}</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
