@extends('layouts.main')

@section('page-title', __('ad.title'))

@section("main-content")
    <h2>@lang('ad.add_advertisement')</h2>
    <x-form action="{{ route('sellers.createadvertisement', ['userId' => $userId]) }}" method="POST">
        <label for="title">@lang('ad.title_label'):</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="description">@lang('ad.description_label'):</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="type">@lang('ad.type_label'):</label><br>
        <select id="type" name="type">
            <option value="Huur">@lang('ad.rent')</option>
            <option value="Verkoop">@lang('ad.sell')</option>
        </select><br>
        <label for="expiration">@lang('ad.expiration_label'):</label><br>
        <input type="date" id="expiration" name="expiration"><br>
        <button type="submit">@lang('ad.add_advertisement_button')</button>
    </x-form>
@endsection
