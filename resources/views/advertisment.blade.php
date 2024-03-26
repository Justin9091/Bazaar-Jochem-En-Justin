@extends('layouts.main')

@section('page-title', $ad["title"])

@section("main-content")
    <div class="w-100 flex gap-3">
        <x-bids :advertisement="$ad" />

        <div class="w-75">
            <h1 class="text-4xl my-3">{{$ad["title"]}}</h1>
            <p>{{$ad["description"]}}</p>

            <div class="flex">
                <x-qr-code :url="env('APP_URL') . '/advertisment/' . $ad['id'] "/>
            </div>
        </div>
    </div>
@endsection
