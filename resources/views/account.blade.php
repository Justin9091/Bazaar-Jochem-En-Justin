@extends('layouts.main')

@section('page-title', 'Account')

@section("main-content")
    <h1 class="text-xl">{{ Auth::user()->name }}</h1>

    @if(Auth::user()->hasRole("business"))
        <button class="{{$button}}">Exporteer registratie</button>
    @endif

    <h1 class="text-3xl">Short url</h1>
    <p>Mooie text, moet toch nog vertaald worden</p>

    <x-form action="/shorturl/edit" method="POST">
        <x-text-input name="short_url" placeholder="New url" />

        <x-submit-button />
    </x-form>


    <h1 class="text-3xl">Favorites</h1>

    <x-list-component :advertisments="$favoriteAds" />
@endsection
