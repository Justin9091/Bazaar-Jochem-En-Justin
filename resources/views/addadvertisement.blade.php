@extends('layouts.main')

@section('page-title', __('ad.title'))

@section("main-content")
    <div class="m-3 p-3 rounded-lg bg-gray-800">
        <h2 class="text-2xl text-center font-bold">@lang('ad.add_advertisement')</h2>
        <x-form action="{{ route('sellers.createadvertisement', ['userId' => $userId]) }}" method="POST">
            <div class="w-full">
                <label for="title">@lang('ad.title_label'):</label>
                <input class="w-full p-1 rounded-lg text-black" type="text" id="title" name="title"><br>
            </div>

            <div class="">
                <label for="description">@lang('ad.description_label'):</label>
                <textarea class="w-full p-1 rounded-lg text-black" id="description" name="description"></textarea><br>
            </div>

            <div class="">

                <label for="type">@lang('ad.type_label'):</label>
                <select id="type" name="type" class="w-full p-1 rounded-lg text-black">
                    <option value="Huur">@lang('ad.rent')</option>
                    <option value="Verkoop">@lang('ad.sell')</option>
                </select>
            </div>

            <div>
                <label for="expiration">@lang('ad.expiration_label'):</label><br>
                <input type="date" id="expiration" name="expiration" class="w-full p-1 rounded-lg text-black" >
            </div>

            <button type="submit">@lang('ad.add_advertisement_button')</button>
        </x-form>
    </div>
@endsection
