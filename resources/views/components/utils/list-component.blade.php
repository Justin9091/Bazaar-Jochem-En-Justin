<!-- In resources/views/components/utils/list-component.blade.php -->
<div class="mx-24">
    <header>
        <x-Form.form action="{{ 'search' }}" method="POST">

            <x-Form.text-input type="text" placeholder="{{ __('components.search_placeholder') }}" name="search-term"
                               class="p-1 m-1 rounded-lg border border-black"
                               value="{{ htmlspecialchars(session()->get('search')) }}"/>

            <x-submit-button value="{{ __('components.search_button') }}"/>
        </x-Form.form>

        @if(session()->has('search'))
            <div id="clear-search">
                <x-Form.form action="/clear-search" method="POST">
                    <x-form.submit-button value="{{ __('components.clear_search_button') }}"/>
                </x-Form.form>
            </div>
        @endif
    </header>

    @if(!$advertisements || count($advertisements) === 0)
        <div class="w-full text-center">
            <i>{{ __('components.no_advertisements_found') }}</i>
        </div>
    @else
        <div>
            @foreach($advertisements as $ad)
                <div class="ad-card">
                    <x-Advertisements.ad-card :ad="$ad"/>
                </div>
            @endforeach
        </div>

        {{ $advertisements->links() }}
    @endif
</div>
