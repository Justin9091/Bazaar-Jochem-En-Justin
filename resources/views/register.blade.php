@extends('layouts.main')

@section('page-title', __('registration.page_title'))

@section('main-content')
    <div class="flex justify-center">
        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg w-1/2">
            <h1 class="text-3xl font-bold text-center pb-3">{{__("registration.register")}}</h1>
            <x-form.form action="{{route('register.store')}}" method="post">

                <div class="flex">
                    <div class="w-full">
                        <p class="px-2">{{ __('registration.firstname') }}</p>
                        <x-form.text-input placeholder="{{ __('registration.firstname') }}" type="text" name="first-name" value="" dusk="first" />
                    </div>

                    <div class="w-full">
                        <p class="px-2">{{ __('registration.infix') }}</p>
                        <x-form.text-input placeholder="{{ __('registration.infix') }}" type="text" name="infix" value="" dusk="infix" />
                    </div>
                    <div class="w-full">
                        <p class="px-2">{{ __('registration.lastname') }}</p>
                        <x-form.text-input placeholder="{{ __('registration.lastname') }}" type="text" name="last-name" value="" dusk="last" />
                    </div>
                </div>

                <div class="">
                    <p class="px-2">{{ __('registration.email')  }}</p>
                    <x-form.text-input placeholder="{{ __('registration.email') }}" type="email" name="email" value="" dusk="email" />
                </div>

                <div class="">
                    <p class="px-2">{{ __('registration.password')  }}</p>
                    <x-form.text-input placeholder="{{ __('registration.password') }}" type="password" name="password" value="" dusk="password" />
                </div>

                <div class="">
                    <p class="px-2">{{ __('registration.confirm_password')  }}</p>
                    <x-form.text-input placeholder="{{ __('registration.confirm_password') }}" type="password"
                                  name="password_confirmation" value="" dusk="password-confirmation" />
                </div>

                <div class="">
                    <input id="advertisement-placement" type="checkbox" name="place-ads" dusk="place-ads">
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

                <div class="flex justify-center">
                    <x-form.submit-button value="{{ __('registration.register') }}" />
                </div>
            </x-form.form>
        </div>
    </div>


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
