@extends('layouts.main')

@section('page-title', 'Account')

@section("main-content")
    <h1 class="text-xl">{{ Auth::user()->name }}</h1>

    @if(Auth::user()->hasRole("business"))
        <button class="{{$button}}">Exporteer registratie</button>
    @endif


    <h1 class="text-3xl">Favorites</h1>

    <x-list-component :advertisments="$favoriteAds" />
@endsection
