@extends('layouts.main')

@section('page-title', __('account.account'))

@section("main-content")
    <div class="container bg-white dark:bg-gray-800 p-3 rounded-lg">

        <h1 class="text-4xl text-center font-bold">{{ Auth::user()->name }}</h1>

        @if(Auth::user()->hasRole("business"))

            <h3 class="text-xl font-bold">Look and feel</h3>

            <form enctype="multipart/form-data" action="/image/logos/{{Auth::getUser()->id}}/" method="POST">
                @csrf
                <input class="p-2 rounded-lg bg-white text-black w-full" type="file" name="image" required>

                <div class="flex justify-center py-3">
                    <x-form.submit-button value="Upload"/>
                </div>
            </form>

            @if(isset($logo))
                <i>Uploaded image:</i>
                <img src="{{$logo}}" alt="Logo">
            @endif
        @endif

        <div class="p-3 bg-gray-500 mt-3 rounded-lg">
            <h3 class="text-xl font-bold">{{ __('account.short_url') }}</h3>
            <p>{{ __('account.enter_personal_ad_url') }}</p>

            <x-form.form action="/shorturl/edit" method="POST">
                <x-form.text-input name="short_url" placeholder="{{ __('account.new_url') }}" type=" " value=""/>

                <x-form.submit-button dusk="new_short_url" value="{{__('account.new_url')}}"/>

                @if($url)
                    <a href="/{{$url}}" class="italic">{{ __('account.go_to_page') }}</a>
                @endif
            </x-form.form>
        </div>

        <div class="py-4 w-full">
            <h3 class="text-xl font-bold text-center">{{__('account.qr')}}</h3>
            <div class="flex justify-center" id="qrCode">
                <x-qr-code :url="env('APP_URL') . '/seller/' . Auth::getUser()->id "/>
            </div>
        </div>

        <h1 class="text-xl text-center font-bold">{{ __('account.favorites') }}</h1>

        <x-utils.list-component :favoriteList="true" :advertisements="$favoriteAds"/>
    </div>
@endsection
