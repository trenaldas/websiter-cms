@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('Pages') }}
        </h2>
        <livewire:tag.index-tag :tags="$tags"/>
    </div>
@endsection
