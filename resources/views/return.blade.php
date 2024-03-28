@extends('layouts.main')

@section("main-content")
    <div class="container bg-gray-800 p-3 rounded-lg text-white">
        <h2 class="text-2xl text-center font-bold">{{__('return.title')}}</h2>

        <form action="/return" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col">
                <label class="font-bold" for="">{{__('return.ad')}}</label>
                <select name="advertisementId" class="p-2 bg-white rounded-lg text-black">
                    @foreach($advertisements as $ad)
                        <option value="{{$ad->id}}">{{$ad->title}}</option>
                    @endforeach
                </select>

                <label class="font-bold" for="">{{__('return.image')}}</label>
                <input type="file" name="image"  class="p-2 bg-white rounded-lg text-black"/>
            </div>

            <div class="flex justify-center pt-2">
                <x-submit-button value="{{ __('return.submit') }}"/>
            </div>
        </form>
        <x-utils.back-button/>
    </div>
@endsection
