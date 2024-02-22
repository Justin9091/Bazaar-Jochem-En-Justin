@extends('layouts.main')

@section("main-content")
    <div class="container">
        <h1 class="seller-name">{{ $user->name }}</h1>
        <h2>Advertisements</h2>
        <div class="advertisements-grid">
            @if ($user->advertisements->isEmpty())
                <p>No advertisements found for this user.</p>
            @else
                @foreach ($user->advertisements as $advertisement)
                    <div class="advertisement-box">
                        <a href="/advertisment/{{$advertisement["id"]}}">
                            <div>
                                <h3>{{$advertisement["title"]}}</h3>
                                <p>{{$advertisement["description"]}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <h2>Reviews</h2>
        <div class="reviews-list">
            @if ($user->reviews->isEmpty())
                <p>No reviews found for this user.</p>
            @else
                    <ul>
                        @foreach ($user->reviews as $review)
                            <x-review title="{{$review->title}}" description="{{$review->description}}" score="{{$review->score}}" reviewer="{{$review->reviewer}}" date="{{$review->date}}"/>
                        @endforeach
                    </ul>
            @endif
        </div>

        <x-add-review userid="{{$user->id}}" reviewer="random"></x-add-review>
    </div>
@endsection


