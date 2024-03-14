@extends('layouts.main')

@section('page-title', __('account.account'))

@section("main-content")
    <h1 class="text-xl">{{ Auth::user()->name }}</h1>

    @if(Auth::user()->hasRole("business"))
        <button class="{{$button}}">{{ __('account.export_registration') }}</button>
    @endif

    <h1 class="text-3xl">{{ __('account.short_url') }}</h1>
    <p>{{ __('account.enter_personal_ad_url') }}</p>

    <x-form action="/shorturl/edit" method="POST">
        <x-text-input name="short_url" placeholder="{{ __('account.new_url') }}"/>

        <x-submit-button/>
    </x-form>

    @if($url)
        <a href="/{{$url}}" class="italic">{{ __('account.go_to_page') }}</a>
    @endif

    <h1 class="text-3xl">{{ __('account.favorites') }}</h1>

    <x-list-component :advertisments="$favoriteAds"/>
@endsection
