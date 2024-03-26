@extends('layouts.main')

@section('page-title', __('account.account'))

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

        <button class="{{$button}}">{{ __('account.export_registration') }}</button>
    @endif

    <h1 class="text-3xl">{{ __('account.short_url') }}</h1>
    <p>{{ __('account.enter_personal_ad_url') }}</p>


    <div class="">
        <h2 class="text-2xl">QR code</h2>
        <div class="flex">
            <x-qr-code :url="env('APP_URL') . '/seller/' . Auth::getUser()->id "/>
        </div>
    </div>

    <h1 class="text-3xl">Favorites</h1>

    <x-list-component :advertisements="$favoriteAds"/>

    <x-form action="/shorturl/edit" method="POST">
        <x-text-input name="short_url" placeholder="{{ __('account.new_url') }}"/>

        <x-submit-button/>
    </x-form>

    @if($url)
        <a href="/{{$url}}" class="italic">{{ __('account.go_to_page') }}</a>
    @endif

    <h1 class="text-3xl">{{ __('account.favorites') }}</h1>

    <x-list-component :advertisements="$favoriteAds"/>

@endsection
