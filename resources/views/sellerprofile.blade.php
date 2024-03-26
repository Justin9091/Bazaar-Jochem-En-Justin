@extends('layouts.main')

@section("main-content")

    @foreach($components as $component)
        @if($component->type == 'text-component')
            <x-text-component :component="$component"/>
        @elseif($component->type == 'image-component')
            <x-image-component :component="$component" />
        @endif
    @endforeach

    <div class="container bg-gray-800 p-3 rounded-lg">
        <h1 class="seller-name text-3xl font-bold mb-4">{{ __('sellersprofile.seller_name', ['name' => $user->name]) }}</h1>

        @if(Auth::check() && Auth::id() == $userid)
            <x-agenda :userid="$user->id"/>
            <div class="p-2 flex justify-between items-center mb-2">
                <div>
                    <h2 class="text-xl font-semibold">{{ __('sellersprofile.offerings') }}</h2>
                    <x-addadvertisement :userid="$user->id"/>
                </div>
                <div class="flex space-x-2">
                    <x-exportcsv :userid="$user->id" />
                </div>
            </div>
        @endif
        <div class="advertisements-grid grid gap-4">

            @if ($user->advertisements->isEmpty())
                <p class="text-white bg-gray-800 rounded-lg p-4">{{ __('sellersprofile.no_offerings') }}</p>
            @else
                @foreach ($user->advertisements as $advertisement)
                    <x-ad-card :color="$user->color" :ad="$advertisement"/>
                @endforeach
            @endif
        </div>

        <x-review-list :userid="$user->id" :adid="0" :reviews="$user->reviews"/>

        <x-backbutton class="absolute bottom-8 left-8"></x-backbutton>
    </div>
@endsection
