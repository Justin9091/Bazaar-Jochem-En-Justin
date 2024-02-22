@extends('layouts.main')

@section('page-title', __('registration.page_title'))

@section('main-content')
    <form action="/register" method="post">
        @csrf

        <div class="flex">
            <x-text-input placeholder="{{ __('registration.firstname') }}" type="text" name="first-name"/>
            <x-text-input placeholder="{{ __('registration.infix') }}" type="text" name="infix"/>
            <x-text-input placeholder="{{ __('registration.lastname') }}" type="text" name="last-name"/>
        </div>

        <x-text-input placeholder="{{ __('registration.email') }}" type="email" name="email"/>
        <x-text-input placeholder="{{ __('registration.password') }}" type="password" name="password"/>
        <x-text-input placeholder="{{ __('registration.confirm_password') }}" type="password" name="password_confirmation"/>

        <div class="">
            <input id="advertisement-placement" type="checkbox" name="place-ads">
            <label for="advertisement-placement">{{ __('registration.place_ads') }}</label>
        </div>

        <div id="advertisement-placement-types" class="hide">
            <div class="">
                <input type="radio" name="account-type" value="individual" id="particular">
                <label for="particular">{{ __('registration.individual') }}</label>
            </div>

            <div class="">
                <input type="radio" name="account-type" value="business" id="business">
                <label for="business">{{ __('registration.business') }}</label>
            </div>
        </div>

        <input class="{{$button}}" type="submit" value="{{ __('registration.register') }}"/>
    </form>

    <script defer>
        let checkbox = document.getElementById('advertisement-placement');
        let advertisementPlacementTypes = document.getElementById('advertisement-placement-types');

        checkbox.addEventListener('change', function () {
            let classList = advertisementPlacementTypes.classList;
            if (checkbox.checked) {
                classList.remove('hide');
                classList.add('show');
            } else {
                classList.remove('show');
                classList.add('hide');
            }
        });
    </script>
@endsection
