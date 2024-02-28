@extends('layouts.main')

@section('page-title', 'Account')

@section("main-content")
    <h1 class="text-xl">{{ Auth::user()->name }}</h1>

    @if(Auth::user()->hasRole("business"))
        <button class="{{$button}}">Exporteer registratie</button>

        <h2 class="text-2xl">Look and feel</h2>

        <form enctype="multipart/form-data" action="/image/logos/{{Auth::getUser()->id}}/" method="POST">
            @csrf
            <input type="file" name="image" required>

            <x-submit-button value="Upload"/>
        </form>
    @endif


    <h1 class="text-3xl">Favorites</h1>

    <x-list-component :advertisments="$favoriteAds" />
@endsection
