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

        @if(isset($logo))
            <img src="{{\Illuminate\Support\Facades\Storage::get($logo)}}" alt="Logo">
        @endif


        <button>{{ __('account.export_registration') }}</button>
    @endif

    <h1 class="text-3xl">{{ __('account.short_url') }}</h1>
    <p>{{ __('account.enter_personal_ad_url') }}</p>

    <x-forms.form action="/shorturl/edit" method="POST">
        <x-forms.text-input name="short_url" placeholder="{{ __('account.new_url') }}"/>

        <x-submit-button/>
    </x-forms.form>

    <div class="">
        <h2 class="text-2xl">QR code</h2>
        <div class="flex">
            <x-qr-code :url="env('APP_URL') . '/seller/' . Auth::getUser()->id "/>
        </div>
    </div>

    @if($url)
        <a href="/{{$url}}" class="italic">{{ __('account.go_to_page') }}</a>
    @endif

    <h1 class="text-3xl">{{ __('account.favorites') }}</h1>

    <x-utils.list-component :advertisements="$favoriteAds"/>

@endsection
