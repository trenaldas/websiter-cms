@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Choose Bit Theme') }}
        </h2>
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            @foreach($bitThemes as $theme)
                <a href="{{ route('bit.create', ['tag_id' => $tagId, 'bit_theme_id' => $theme->id]) }}" class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        {{ $theme->name }}
                    </h4>
                    <p class="text-gray-600 dark:text-gray-400">
                        Picture as an example here
                    </p>
                </a>
            @endforeach
        </div>
    </div>
@endsection
