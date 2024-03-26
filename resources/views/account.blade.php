@extends('layouts.main')

@section('page-title', 'Account')

@section("main-content")
    <h1 class="text-xl">{{ Auth::user()->name }}</h1>

    @if(Auth::user()->hasRole("business"))
        <button>Exporteer registratie</button>

        <h2 class="text-2xl">Look and feel</h2>

        <form enctype="multipart/form-data" action="/image/logos/{{Auth::getUser()->id}}/" method="POST">
            @csrf
            <input type="file" name="image" required>

            <x-submit-button value="Upload"/>
        </form>
    @endif


    <div class="">
        <h2 class="text-2xl">QR code</h2>
        <div class="flex">
            <x-qr-code :url="env('APP_URL') . '/seller/' . Auth::getUser()->id "/>
        </div>
    </div>

    <h1 class="text-3xl">Favorites</h1>

    <x-list-component :advertisments="$favoriteAds"/>
@endsection
