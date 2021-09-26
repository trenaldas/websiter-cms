@extends('layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        <span class="text-purple-500">{{ $bit->name }}</span> {{ __('Bit') }} <span class="text-sm">({{ $bit->bitTheme->name }})</span>
        </h2>
        <livewire:bit.edit-bit :bit="$bit" :parentBits="$parentBits"/>
    </div>
@endsection
