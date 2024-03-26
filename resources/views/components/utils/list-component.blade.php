<!-- In resources/views/components/utils/list-component.blade.php -->
<div class="mx-24">
    <header>
        <x-form action="{{ 'search' }}" method="POST">
            <x-text-input type="text" placeholder="Zoekterm" name="search-term"
                   class="p-1 m-1 rounded-lg border border-black" value="{{ htmlspecialchars(session()->get('search')) }}"  />

            <x-submit-button value="Zoek" />
        </x-form>

        @if(session()->has('search'))
            <x-form action="/clear-search" method="POST">
                <x-submit-button value="Verwijder zoekterm" />
            </x-form>
        @endif
    </header>

    @if(!$advertisements || count($advertisements) === 0)
        <div class="w-full text-center">
            <i>Geen advertenties gevonden!</i>
        </div>
    @else
        <div>
            @foreach($advertisements as $ad)
                <div class="ad-card">
                    <x-ad-card :ad="$ad"/>
                </div>
            @endforeach
        </div>

        {{ $advertisements->links() }}
    @endif
</div>
