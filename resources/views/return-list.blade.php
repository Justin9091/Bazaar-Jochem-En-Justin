@extends('layouts.main')

@section('page-title', __('return.title'))

@section("main-content")

    <div class="container text-white bg-gray-800 p-3 rounded-lg">
        <h2 class="text-2xl font-bold">{{$advertisement->title}}</h2>

        <div class="grid grid-cols-5 gap-3">
            @foreach($returns as $return)
                <div class="p-3 bg-gray-500 rounded-lg">
                    <img src="{{\Illuminate\Support\Facades\Storage::url("images/returnedItems/".$return["image"])}}" alt="Returned item">
                    <b>{{__('return.damage')}}: </b> {{$return['damage']}}<br>
                    <i>{{$return['updated_at']}}</i>
                </div>
            @endforeach
        </div>

        <x-utils.back-button />
    </div>

@endsection
