@extends('layouts.main')

@section("main-content")
    <div class="container">
        <h1 class="seller-name">{{ $user->name }}</h1>
        <h2>Aanbiedingen</h2>

        <x-addadvertisment userid="{{$user->id}}"></x-addadvertisment>

        <a href="{{ route('sellers.createcsv', ['userId' => $user->id]) }}" class="btn btn-primary">Create CSV</a>

        <form action="{{ route('sellers.importcsv', ['userId' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="csv_file">Select CSV File to Import:</label>
                <input type="file" class="form-control-file" id="csv_file" name="csv_file">
            </div>
            <button type="submit" class="btn btn-primary">Import CSV</button>
        </form>



        <div class="advertisements-grid">
            @if ($user->advertisements->isEmpty())
                <p>Geen aanbiedingen voor deze verkoper</p>
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
                <p>Geen reviews voor deze verkoper</p>
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


