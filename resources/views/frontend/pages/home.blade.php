@extends('frontend.layouts.master')

@section('content')
    @include('frontend.components.slider')

    {{-- @include('frontend.components.message') --}}

    @include('frontend.components.category')

    @include('frontend.components.about')

    {{-- @include('frontend.components.certificates') --}}

    @include('frontend.components.products')

    @include('frontend.components.clients')

    @include('frontend.components.team')

    @include('frontend.components.photos')

    {{-- @include('frontend.components.videos') --}}
@endsection
