<!-- In resources/views/components/utils/list-component.blade.php -->
<div class="mx-24">
    <header>
        <form action="{{ 'search' }}" method="POST">
            @csrf

            <x-text-input type="text" placeholder="Zoekterm" name="search-term"
                   class="p-1 m-1 rounded-lg border border-black" value="{{ htmlspecialchars(session()->get('search')) }}"  />

            <x-submit-button value="Zoek" />
        </form>

        @if(session()->has('search'))
            <form action="/clear-search" method="POST">
                @csrf
                <x-submit-button value="Verwijder zoekterm" />
            </form>
        @endif
    </header>

    @if(!$advertisments || count($advertisments) === 0)
        <div class="w-full text-center">
            <i>Geen advertenties gevonden!</i>
        </div>
    @else
        <div>
            @foreach($advertisments as $ad)
                <div class="ad-card">
                    <x-ad-card :ad="$ad"/>
                </div>
            @endforeach
        </div>

        {{ $advertisments->links() }}
    @endif
</div>
