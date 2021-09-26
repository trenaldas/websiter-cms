@extends('layouts.app')

@section('content')
    <livewire:shipping-method.index-shipping-method :methods="$methods"/>
@endsection
