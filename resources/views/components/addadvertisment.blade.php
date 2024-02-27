@if(Auth::check() && Auth::id() == $userid)
    <a href="{{ route('sellers.addadvertisement', ['userId' => $userid]) }}">Aanbieding toevoegen</a>
    {{ auth()->id() }}
@endif

