@extends('layouts.main')

@section("main-content")
    <div class="container">
        <h1 class="seller-name text-3xl font-bold mb-4">{{ $user->name }}</h1>
        @if(Auth::check() && Auth::id() == $userid)
            <div class="p-2 flex justify-between items-center mb-2">
                <div>
                    <h2 class="text-xl font-semibold">Aanbiedingen</h2>
                    <x-addadvertisment userid="{{$user->id}}"></x-addadvertisment>
                </div>
                <div class="flex space-x-2">
                    <x-exportcsv :userid="$user->id" />
                </div>
            </div>
        @endif
        <div class="advertisements-grid grid gap-4">
            @if ($user->advertisements->isEmpty())
                <p class="text-white bg-gray-800 rounded-lg p-4">Geen aanbiedingen voor deze verkoper</p>
            @else
                @foreach ($user->advertisements as $advertisement)
                    <div class="advertisement-box bg-gray-600 border border-gray-800 shadow-md rounded-lg p-4">
                        <a href="/advertisment/{{$advertisement["id"]}}" class="block">
                            <h3 class="text-xl font-semibold text-white">{{$advertisement["title"]}}</h3>
                            <p class="mt-2 text-white">{{$advertisement["description"]}}</p>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <h2 class="text-xl font-semibold mt-8 mb-2">Reviews</h2>
        <div class="reviews-list">
            @if ($user->reviews->isEmpty())
                <p class="text-white bg-gray-800 rounded-lg p-4">Geen reviews voor deze verkoper</p>
            @else
                <ul>
                    @foreach ($user->reviews as $review)
                        <x-review title="{{$review->title}}" description="{{$review->description}}" score="{{$review->score}}" reviewer="{{$review->reviewer}}" date="{{$review->date}}"/>
                    @endforeach
                </ul>
            @endif
            <x-add-review userid="{{$user->id}}" reviewer="verander nog ooit"></x-add-review>
        </div>
    </div>
    <x-backbutton class="absolute bottom-8 left-8"></x-backbutton>
@endsection
