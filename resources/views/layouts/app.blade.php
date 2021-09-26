@extends('layouts.skeleton')

@section('app')
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        @include('layouts.sidenav')
        <div class="flex flex-col flex-1">
            @include('layouts.topbar')
            <main class="h-full pb-16 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
@endsection
