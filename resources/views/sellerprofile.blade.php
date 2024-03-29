@extends('layouts.main')

@section("main-content")
    <div class="container bg-gray-800 p-3 rounded-lg">
        @foreach($components as $component)
            @if($component->type == 'text-component')
                <x-Components.text-component :component="$component"/>
            @elseif($component->type == 'image-component')
                <x-Components.image-component :component="$component"/>
            @endif
        @endforeach

        @if(Auth::check() && Auth::id() == $userid)
            <x-agenda :userid="$user->id"/>
            <div class="p-2 flex justify-between items-center mb-2">
                <div>
                    <h2 class="text-xl font-semibold">{{ __('sellersprofile.offerings') }}</h2>
                    <x-Advertisements.addadvertisement :userid="$user->id"/>
                </div>
                <div class="flex space-x-2">
                    <x-exportcsv :userid="$user->id"/>
                </div>
            </div>

            <div class="">
                <h2 class="text-xl font-bold">{{__('sellersprofile.return_item_title')}}</h2>
                <a href="/return">
                    <x-utils.button
                        :type="\App\enum\ButtonType::BLUE">{{__('sellersprofile.return_item_button')}}</x-utils.button>
                </a>

                @if (!$user->advertisements->isEmpty())
                    <x-form.form method="POST" action="/return/list">
                        <select name="advertisement" class="p-2 bg-white rounded-lg text-black">
                            @foreach ($user->advertisements as $advertisement)
                                <option value="{{$advertisement->id}}">{{$advertisement->title}}</option>
                            @endforeach
                        </select>

                        <x-submitbutton value="{{__('sellersprofile.return_item_list')}}" />
                    </x-form.form>
                @endif
            </div>
        @endif

        <div class="py-3">
            <h2 class="text-xl font-semibold p-3">{{ __('sellersprofile.offerings') }}</h2>
            <div class="advertisements-grid grid gap-4">

                @if ($user->advertisements->isEmpty())
                    <p class="text-white bg-gray-800 rounded-lg p-4">{{ __('sellersprofile.no_offerings') }}</p>
                @else
                    @foreach ($user->advertisements as $advertisement)
                        <x-Advertisements.ad-card :color="$user->color" :ad="$advertisement"/>
                    @endforeach
                @endif
            </div>
        </div>

        <x-reviews.review-list :userid="$user->id" :adid="0" :reviews="$user->reviews"/>

        <x-utils.backbutton class="absolute bottom-8 left-8"></x-utils.backbutton>
    </div>
@endsection
